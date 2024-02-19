<?php

namespace App\Http\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function Composer\Autoload\includeFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManager;


use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use App\Models\Gallery;

class ArticleController extends Controller
{
    public function Direct($id)
    {
        $article = Article::findOrFail($id);

        return redirect()->route('Article > Single', $article->slug);
    }

    public function All() {
        $articles = Article::latest()->where('state', '=', 1)->paginate(2);
        return ArticleResource::collection($articles);
    }

    public function NoArabic($input) {
        $output = str_replace('ي', 'ی', $input);
        $output = str_replace('ك', 'ک', $output);
        return $output;
    }

    public function NoRelatives($input) {
        $relative = 'src="../../';
        $absolute = 'src="'.ENV('APP_URL')."/";
        $output = str_replace($relative, $absolute , $input);
//        return $output;
        return $input;
    }

    public function sendToTelegram($article) {
        $title = $article->title;
        $lead = $article->lead;
        $link = "https://smtnews.ir/direct/".$article->id;
        $key = env('TELEGRAM_BOT_API_KEY');
        $url = "https://api.telegram.org/bot$key/sendPhoto";

        $content = "<b>✍️$title</b>" . PHP_EOL ."🔸$lead" . PHP_EOL ."ادامه خبر را در لینک زیر بخوانید: 👇👇👇👇" . PHP_EOL ."<a href='$link'>$link</a>" . PHP_EOL ."📲به کانال صمت بپیوندید" . PHP_EOL ."@smtnews روزنامه صمت";

        $params = [
            "photo" => $article->cover,
            "chat_id" => "@smtnews",
            "caption"=> "$content",
            "parse_mode" => "HTML"
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        /*
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        */

        $res = curl_exec($curl);
        $response = json_decode($res, true);
        Log::info($response);
    }

    public function New()
    {
        $categories = Category::where('active', '1')->get();
        $tags = Tag::all();
        return view('admin.article.new', compact(['categories', 'tags']));
    }

    public function Submit(Request $request)
    {

        $request->validate([
            'title' => 'required|min:1|max:400',
            'content' => 'required|min:1',
//            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->has('new_categories') && count($request['new_categories']) > 0) {
            $user_categories = [];
            foreach ($request['new_categories'] as $value) {
                if (!is_null($value)) {
                    $category = new Category();
                    $category->name = $value;
                    $category->slug = SlugService::createSlug(Category::class, 'slug', $value);
                    $category->save();
                    $user_categories[] = $category->id;
                }
            }
        }

        if($request->has('new_tags') && count($request['new_tags']) > 0) {
            $user_tags = [];
            foreach ($request['new_tags'] as $value) {
                if (!is_null($value)) {
                    $tag_exists = Tag::where('name', $value)->first();
                    $can_insert_new_tag = (is_null($tag_exists)) ? 1 : 0 ;
                    if($can_insert_new_tag) {
                        $tag = new Tag();
                        $tag->name = $value;
                        $tag->slug = SlugService::createSlug(Category::class, 'slug', $value);
                        $tag->save();
                        $user_tags[] = $tag->id;
                    } else {
                        $user_tags[] = $tag_exists->id;
                    }
                }
            }
        }


        $fileName = 'ghost.png';
//        if ($request->hasFile('cover')) {
//            // Get filename.extention
//            $image = $request->file('cover')->getClientOriginalName();
//            // Get just file name
//            $imageName = pathinfo($image, PATHINFO_FILENAME);
//            // Get just file extention
//            $imageExtention = $request->file('cover')->getClientOriginalExtension();
//            // Make unique file name
//            $fileName = $imageName . '_' . time() . '.' . $imageExtention;
//            // Store for public uses
//            $path = $request->file('cover')->storeAs('public/uploads/articles/images', $fileName);
//
//        }

        if ($request->has('cover') && !is_null($request->cover)) {
            $fileName = $request->cover;
//            $this->CompressImage($fileName);
        }

        $article = new Article();
        $article->title = $this->NoArabic($request['title']);
        $article->content = $this->NoArabic($request['content']);
        $article->content = $this->NoRelatives($request['content']);

        $article->rootitr = $this->NoArabic($request['rootitr']);
        $article->lead = $this->NoArabic($request['lead']);
        $article->writer = $this->NoArabic($request['writer']);

        $article->meta_description = isset($request['meta-description']) ? $this->noArabic($request['meta-description']) : '';
        $article->meta_robots = isset($request['meta-robots']) ? $request['meta-robots'] : 'index, follow';

        $article->cover = $fileName;

        if($request->has('cover') && !is_null($request->cover) && $request['type'] == 'video') {
            $helper = new HelperController();
            $cover = $helper->VideoFromThumbnail($request['cover'], time());
            $article->video_url = $request['cover'];
            $article->cover = $cover;
        }
        $article->user_id = Auth::id();

        $v = Verta();
        $date = Verta::jalaliToGregorian($request['created_year'],$request['created_month'],$request['created_day']);
        $date = $date[0] . '-' . $date[1] . '-' . $date[2];
        $min = ($request['created_minute'] < 10) ? '0' . $request['created_minute'] : $request['created_minute'];
        $hour = ($request['created_hour'] < 10) ? '0' . $request['created_hour'] : $request['created_hour'];
        $article->created_at = $date. ' ' . $hour . ':' . $min . ':00' ;
        $article->gallery_id = $request['gallery'];
        $article->type = $request['type'];

        if ($request['publish']) {
            $article->state = 1;
            $article->previous_state = 1;
        }

        if ($request->has('publish_and_new') && $request['publish_and_new']) {
            $article->state = 1;
            $article->previous_state = 1;
        }

        if ($request['draft']) {
            $article->state = 0;
            $article->previous_state = 0;
        }
        $article->save();

        $article->category()->attach($request['categories']);

        if (isset($user_categories) && count($user_categories) > 0) {
            $article->category()->attach($user_categories);
        }

        $article->tag()->attach($request['tags']);

        if (isset($user_tags) && count($user_tags) > 0) {
            $article->tag()->attach($user_tags);
        }

        $log = $article->created_at . " - article created. | id:" . $article->id . " | state:";
        $log .= $article->state ? 'published' : 'draft';

        Log::info($log);

        if ($request->has('cover') && !is_null($request->cover)) {
            if($request->has('action_send_telegram') && $request['action_send_telegram'] == 'on') {
                $this->sendToTelegram($article);
            }
        }

        if ($request->has('publish_and_new') && $request['publish_and_new']) {
            return redirect(route('Article > New'));
        } else {
            return redirect(route('Article > Edit', $article->id));
        }
    }

    public function Manage(Request $request)
    {
        $categories = Category::all();
        $users = User::all();
        $articles = Article::where('id', '>', 0);

        // to fetch by category
        if ($request->has('category') && $request['category'] != 'all') {
            $articles = $articles->whereHas('category', function ($query) use ($request) {
                $query->where('id', $request['category']);
            });
        }
        // to fetch by user
        if ($request->has('author') && $request['author'] !== 'all') {
            $articles = $articles->where('user_id', $request['author']);
        }

        // to fetch deleted items
        elseif ($request->has('state') && $request['state'] == '-1') {
//            $articles = Article::where('state', '-1')->latest()->paginate(15);
            $articles = $articles->where('state', '-1');
        }

        // to fetch drafted items
        elseif ($request->has('state') && $request['state'] == '0') {
//            $articles = Article::where('state', '0')->latest()->paginate(15);
            $articles = $articles->where('state', '0');
        }

        // to fetch all items [except deleted]
        else {
//            $articles = Article::where('state', '!=', -1)->latest()->paginate(15);
            $articles = $articles->where('state', '!=', -1);
        }

        // to handle search query
        if ($request->has('query') && !is_null($request['query'])) {
            $articles = $articles->where('title', 'LIKE', '%' . $request['query'] . '%');
        }

//        $articles = $articles->orderBy('id', 'desc')->paginate(30);
        $articles = $articles->orderBy('created_at', 'desc')->paginate(30)
        ->appends(request()->query());
        return view('admin.article.manage', compact(['articles', 'categories', 'users']));
    }

    public function Show($slug, Request $request)
    {
//        $article = Article::where('slug', '=', $slug)->get();

        $article = Article::with('comment')->where('slug', '=', $slug)->get();

        $relateds = $article[0]->tag->take(6)->first();
        $relateds = (is_null($relateds)) ? [] : $relateds->article()
            ->latest()
            ->whereNot('id', $article[0]->id)
            ->where('state', '1')
            ->limit(6)
            ->get();

        if (count($article) && ($article[0]->state == 1) && $article[0]->category->first()->id == env('NEWSPAPER_CATEGORY_ID') ) {
            return view('public.article.newspaper', compact(['article']));
        }

        if (!count($article) || ($article[0]->state !== 1)) {
            return abort('404', 'Not Found.');
        } else {

            if (!is_null($article[0]->external_url)) {
                return Redirect::to($article[0]->external_url, 301);
            }

            Article::where('slug', '=', $slug)->increment('views');

            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            // Create a new Laravel collection from the array data
            // $itemCollection = collect($items);
            $itemCollection = collect($article[0]->comment->where('approved', 1)->reverse());

            // Define how many items we want to be visible in each page
            $perPage = 15;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

            // set url path for generted links
            $paginatedItems->setPath($request->url());

            $comments = $paginatedItems;

            $gallery = false;
            if (!is_null($article[0]->gallery_id)) {
                $gallery = Gallery::where('timestamp', $article[0]->gallery_id)->get();
                if (count($gallery)) {
                    $gallery = $gallery[0]->content;
                } else {
                    $gallery = false;
                }
            }

            $template = (in_array(env('NOTES_CATEGORY_ID'), $article[0]->category->pluck('id')->all())) ? 'notes' : 'single';
            return view("public.article.$template", compact(['article', 'comments', 'gallery', 'relateds']));
        }
    }

    public function Edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.edit', compact(['article', 'id', 'categories', 'tags']));
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:1|max:400',
            'content' => 'required|min:1|',
//            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->has('new_categories') && count($request['new_categories']) > 0) {
            $user_categories = [];
            foreach ($request['new_categories'] as $value) {
                if (!is_null($value)) {
                    $category = new Category();
                    $category->name = $value;
                    $category->slug = SlugService::createSlug(Category::class, 'slug', $value);
                    $category->save();
                    $user_categories[] = $category->id;
                }
            }
        }

        if($request->has('new_tags') && count($request['new_tags']) > 0) {
            $user_tags = [];
            foreach ($request['new_tags'] as $value) {
                if (!is_null($value)) {
                    $tag_exists = Tag::where('name', $value)->first();
                    $can_insert_new_tag = (is_null($tag_exists)) ? 1 : 0 ;
                    if($can_insert_new_tag) {
                        $tag = new Tag();
                        $tag->name = $value;
                        $tag->slug = SlugService::createSlug(Category::class, 'slug', $value);
                        $tag->save();
                        $user_tags[] = $tag->id;
                    } else {
                        $user_tags[] = $tag_exists->id;
                    }
                }
            }
        }

//        if ($request->hasFile('cover')) {
//            // Get filename.extention
//            $image = $request->file('cover')->getClientOriginalName();
//            // Get just file name
//            $imageName = pathinfo($image, PATHINFO_FILENAME);
//            // Get just file extention
//            $imageExtention = $request->file('cover')->getClientOriginalExtension();
//            // Make unique file name
//            $fileName = $imageName . '_' . time() . '.' . $imageExtention;
//            // Store for public uses
//            $path = $request->file('cover')->storeAs('public/uploads/articles/images', $fileName);
//        }

        $article = Article::find($id);

        $article->title = $this->NoArabic($request['title']);
        $article->content = $this->NoArabic($request['content']);
        $article->content = $this->noRelatives($request['content']);

        $article->rootitr = $this->NoArabic($request['rootitr']);
        $article->lead = $this->NoArabic($request['lead']);
        $article->writer = $this->NoArabic($request['writer']);

        $article->meta_description = isset($request['meta-description']) ? $this->NoArabic($request['meta-description']) : '';
        $article->meta_robots = isset($request['meta-robots']) ? $request['meta-robots'] : 'index, follow';
        $article->meta_canonical = isset($request['meta_canonical']) ? $request['meta_canonical'] : null;
        $article->external_url = isset($request['external_url']) ? $request['external_url'] : null;


        $fileName = 'ghost.png';

        if ($request->has('cover') && !is_null($request->cover)) {
            if ($request['type'] == 'video') {
                $helper = new HelperController();
                $cover = $helper->VideoFromThumbnail($request['cover'], time());
                $article->video_url = $request['cover'];
                $article->cover = $cover;
            } else {
                $article->cover = $request['cover'];
            }
        } elseif($request->has('cover') && is_null($request->cover) && !is_null($article->cover)) {
            $noJob = 0;
        } else {
            $article->cover = $fileName;
        }

        if ($request->has('remove_cover') && $request['remove_cover']) {
            $article->cover = null;
        }


        $v = Verta();
        $date = Verta::jalaliToGregorian($request['created_year'],$request['created_month'],$request['created_day']);
        $date = $date[0] . '-' . $date[1] . '-' . $date[2];
        $min = ($request['created_minute'] < 10) ? '0' . $request['created_minute'] : $request['created_minute'];
        $hour = ($request['created_hour'] < 10) ? '0' . $request['created_hour'] : $request['created_hour'];
        $article->created_at = $date. ' ' . $hour . ':' . $min . ':00' ;
        $article->gallery_id = $request['gallery'];
        $article->type = $request['type'];

        if ($request->has('remove_cover') && $request['remove_cover']) {
            $article->cover = null;
        }

        if ($request['draft']) {
            $article->state = $article->previous_state;
            $article->state = 0;
        }
        if ($request['publish']) {
            $article->state = $article->previous_state;
            $article->state = 1;
        }

        $article->save();

        $article->category()->sync($request['categories']);

        if (isset($user_categories) && count($user_categories) > 0) {
            $article->category()->attach($user_categories);
        }

        $article->tag()->sync($request['tags']);

        if (isset($user_tags) && count($user_tags) > 0) {
            $article->tag()->attach($user_tags);
        }

        return redirect(route('Article > Edit', $id));
    }

    public function DeleteTemporary($id)
    {
        $article = Article::find($id);
        $article->previous_state = $article->state;
        $article->state=-1;
        $article->save();
        return back();
    }

    public function DeletePermanently($id)
    {
        $article = Article::where('id',$id)->delete($id);
        return back();
    }

    public function Delete($id)
    {
        // $article = Article::find($id)->delete();
        $article = Article::find($id);
        Storage::delete('public/uploads/articles/images/' . $article->cover);
        $article->delete();
        return back();
    }

    public function Restore($id)
    {
        $article = Article::find($id);
        $article->state = $article->previous_state;
        $article->save();
        return back();
    }


    /**
     * Define custom methods to do some magics!
     * Not finished yet ...
     */
    private function ObjectToArray(object $object, array $properties)
    {
        $array = array();
        $objects = $object;
        foreach ($objects as $current) {
            foreach ($properties as $property) {
                $array[][$property] = $current->$property;
            }
        }
        return $array;
    }

    public function GetCategoriesFromID ($id) {
        return DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_categories` WHERE `id` = $id")[0];
    }

    public function GetPostTagsFromID ($id) {
        $tags_id = DB::connection('mysql_sec')->select("SELECT `tag_id` as `id` FROM `smtnw6_contentitem_tag_map` WHERE `content_item_id` = $id");

        $tags = [];
        foreach ($tags_id as $tag_id) {
            // print_r(var_dump($tag_id) . "<br/>");
            array_push ($tags, DB::connection('mysql_sec')->select("SELECT `title` FROM `smtnw6_tags` WHERE `id` = {$tag_id->id}")[0]);
        }
        return $tags;
    }

// public function OldEngineSimple ($param_1, $id, $slug) {
        public function OldEngineSimple ($slug) {
        $slug = urlencode(urldecode($slug));
        $article = DB::connection('mysql_sec')->select("SELECT * FROM `wp_posts` WHERE `post_type` = 'post' AND `post_status` = 'publish' AND `post_name` = '$slug'");
        if (!count($article)) {
            return abort('404');
        } else {
            $article = $article[0];
        }
        $article_info = [
            'id' => $article->ID,
            'title' => $article->post_title,
            'intro_text' => $article->post_excerpt,
            'content' => $article->post_content,
            'cover' => '/assets/image/ghost.png',
            'views' => 0,
            'created_by' => '',
            'created_at' => $article->post_date,
            'created_at_gmt' => $article->post_date_gmt,
            'published_at' => $article->post_date,
            'category' => null,
            'category_id' => null,
            'tag' => null,
            'tag_id' => null,
            'slug' => '/',
            'tags' => null,
            'meta_description' => $article->post_title,
            'meta_title' => $article->post_title,
            'meta_robots' => 'index, follow',
            'meta_canonical' => $_SERVER['PHP_SELF'],
            'rootitr' => null,
            'lead' => null,
            'writer' => null,
            'type' => 'article',
            'is_old_article' => true,
        ];
        if (isset($_GET['json'])) {
            return $article_info;
        }
        $article = [(object) $article_info];
        $gallery = false;
        $comments = [];
//        return view('old.theme.single', compact('article_info'));
        return view('public.article.single', compact(['article', 'gallery', 'comments']));
    }

//    public function OldEngineComplex ($param_1, $param_2, $id, $slug) {
    public function OldEngineComplex ($param_1, $param_2, $id) {
        $article = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_content` WHERE `id` = $id");
        if (!count($article)) {
            return abort('404');
        } else {
            $article = $article[0];
        }

        $article_info = [
            'id' => $article->id,
            'title' => $article->title,
            'intro_text' => $article->introtext,
            'content' => $article->fulltext,
            'cover' => json_decode($article->images)->image_intro,
            'views' => $article->hits,
            'created_by' => $article->created_by_alias,
            'created_at' => $article->created,
            'published_at' => $article->publish_up,
            'category' => $this->GetCategoriesFromID($article->catid)->title,
            'category_id' => $this->GetCategoriesFromID($article->catid)->id,
            'tags' => $this->GetPostTagsFromID($article->id),
        ];

        // return $article_info;
        if (isset($_GET['json'])) {
            return $article_info;
        }
        return view('old.theme.single', compact('article_info'));
    }

    public function MakeThumb($address = 'http://localhost:8000/storage/uploads/articles/images/1.jpg') {
        /** http://localhost:8000/storage/uploads/articles/images/1-seat-sofa-2-min.png */
        //$address = str_replace(env('APP_URL'), '', $address);
        //$address = str_replace(env('SITE_URL'), '', $address);
        //$address = trim($address, '/');
        $path_parts = pathinfo($address);
        $ext = $path_parts['extension'];
        $thumb_address = str_replace(".$ext", "-170-113.$ext", $address);
        $manager = new ImageManager();
        $image = $manager->make($address)->resize(170, 113);
        $image->save($thumb_address);
//        return $image->response($ext);
    }

}
