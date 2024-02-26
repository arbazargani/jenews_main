<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Setting;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // auth middleware for entire application
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Index(Request $request)
    {
        if(Cache::has('level_one_articles')) {
            $level_one_articles = Cache::get('level_one_articles');
        } else {
            $level_one_articles = Category::where('id', env('LEVEL_one_CATEGORY_ID'))->with(['article' => function($query)
                {
                    $query->where('cover', '!=', 'ghost.png')
                        ->latest()->take(4);
                }]
            )->get();
            Cache::put('level_one_articles', $level_one_articles, now()->addMinutes(5));
        }

    //    dd($level_one_articles);

        if(Cache::has('homeTitle')) {
            $homeTitle = Cache::get('homeTitle');
        } else {
            $homeTitle = Setting::where('name', 'meta_title')->first();
            Cache::put('menu_structure', $homeTitle, now()->addDays(2));
        }

        if(Cache::has('homeDescription')) {
            $homeDescription = Cache::get('homeDescription');
        } else {
            $homeDescription = Setting::where('name', 'meta_description')->first();
            Cache::put('homeDescription', $homeDescription, now()->addDays(2));
        }


        $marketInventory = $this->GetCategoryLatest('بازار-سرمایه');

        $mineAndIndustry = $this->GetCategoryLatest('صنعت-و-معدن');

        $housing = $this->GetCategoryLatest('مسکن');

        $exchange = $this->GetCategoryLatest('بورس');

        $technology = $this->GetCategoryLatest('فناوری');

        if ($request->isMethod('get')) {
            if ($request->has('query') && !is_null($request['query'])) {
                $query = $request['query'];
                $articles = Article::with('Tag')->where([
                    ['state', '=', 1],
                    ['created_at', '<=', Carbon::now()],
                    ['title', 'LIKE', '%' . $query . '%']
                ])->orWhere([
                    ['state', '=', 1],
                    ['created_at', '<=', Carbon::now()],
                    ['content', 'LIKE', '%' . $query . '%']
                ])->orWhere([
                    ['state', '=', 1],
                    ['created_at', '<=', Carbon::now()],
                    ['writer', 'LIKE', '%' . $query . '%']
                ])->orWhereHas('Tag', function($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%');
                })->paginate(10)
                ->appends(request()->query());

                return view('public.home.search', compact('articles'));
            }
        }

        return view('public.home.index', compact([
            'level_one_articles',
            'homeTitle',
            'homeDescription',
            'marketInventory',
            'mineAndIndustry',
            'housing',
            'exchange',
            'technology'
        ]));
    }

    public function Archive() {
        $articles = Article::where([
                ['state', '=', 1],
                ['created_at', '<=', Carbon::now()]
            ])
            ->latest()->paginate(100);
        // return $articles;
        return view('public.home.archive', compact(['articles']));
    }

    /**
     * @param $query
     */
    public function OldSearch(Request $request) {
        if ($request->isMethod('get')) {
            if ($request->has('query') && !is_null($request['query'])) {
                $query = $request['query'];
                $qlimit = 20;
                $query = "SELECT * FROM `wp_posts` WHERE `post_type` = 'post' AND
                `post_title` LIKE '%$query%'
                AND `post_status` = 'publish'
                OR `post_content` LIKE '%$query%'
                ORDER BY `post_date_gmt`
                LIMIT $qlimit";

                if ($request->has('page') && !is_null($request['page']) && $request['page'] > 1) {
                    $qoffset = $request['page']*20;
                    $query .= " OFFSET $qoffset";
                }
                $articles = DB::connection('mysql_sec')->select($query);
//                 return $articles;
            }
        }
        if (!isset($articles)) {
            $articles = false;
            $query = '';
            return view('public.home.oldsearch', compact(['articles']));

        }

        // $articles = $this->arrayPaginatorV2($articles, $request);
        // $articles = new Paginator($articles, 20);

        // return var_dump(count($articles));

        return view('public.home.oldsearch', compact(['articles']));
    }

    public function arrayPaginatorV1($array, $request) {
        $page = Input::get('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

    public function arrayPaginatorV2($array, $request) {
        $page = Input::get('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice(
                $array,
                $offset,
                $perPage,
                true
            ),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

    public function GetOldNewsCategoriesFromID ($id) {
        return DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_categories` WHERE `id` = $id")[0];
    }

    public function GetCategoryLatest_backup($slug, $limit = 3) {
        if (Cache::has("latest-$slug")) {
            return Cache::get("latest-$slug");
        } else {
            $data = Category::where('slug', "$slug")->with(['article' => function($query) use ($limit)
            {
                $query->where('cover', '!=', 'ghost.png')
                    ->where('created_at', '<=', Carbon::now())
                    ->limit($limit)
                    ->latest();
            }
            ])->get();
            $data = (count($data) >= 1) ? $data[0]->article : false;
            Cache::put("latest-$slug", $data, now()->addMinutes(5));
            dd($data);
            return $data;
        }
    }

    public function GetCategoryLatest($slug, $limit = 3) {
        if (Cache::has("latest-$slug")) {
            return Cache::get("latest-$slug");
        } else {
            $category = Category::where('slug', "$slug")->first();
            if (!is_null($category)) {
                $data = Article::where('category_id', $category->id)
                    ->where('cover', '!=', 'ghost.png')
                    ->where('created_at', '>=', Carbon::today()->subDays(2))->where('created_at', '<=', Carbon::now())
                    ->limit($limit)
                    ->latest()->get();
            }
            Cache::put("latest-$slug", $data, now()->addMinutes(5));
            return $data;
        }
    }

    public function Faker()
    {
        $article = factory(Article::class, 100)->create();
    }

    public function MenuStructureWithParents()
    {
        if (Cache::has('MenuStructureWithParents')) {
            return Cache::get('MenuStructureWithParents');
        } else {

            $menu_structure = Category::where('id', '!=', '1')
                ->where('parent', '!=', -1)
                ->where('show_in_menu', '=', 1)
                ->where('active', '=', 1)
                ->get()->groupBy('parent');
            Cache::put('MenuStructureWithParents', $menu_structure, now()->addDays(2));
            return $menu_structure;
        }
        /**
        if (Cache::has('menu_structure')) {
            return Cache::get('menu_structure');
        } else {
            $menu_structure = Category::where('id', '!=', '1')->where('parent', '!=', -1)->where('show_in_menu', '=', 1)->get()->groupBy('parent');
            Cache::put('menu_structure', $menu_structure, now()->addDays(2));
            return $menu_structure;
        }
        */
    }

    public function MenuStructureWithoutParents()
    {
        if (Cache::has('single_categories')) {
            return Cache::get('single_categories');
        } else {
            $menu_structure = $this->MenuStructureWithParents();
            $used_categories = [1];
            foreach ($menu_structure as $parents => $childs) {
                $used_categories[] = $parents;
            }
            $single_categories = Category::where('parent', -1)->where('active', '=', 1)->WhereNotIn('id', $used_categories)->where('show_in_menu', '=', 1)->get();

            Cache::put('single_categories', $single_categories, now()->addDays(2));
            return $single_categories;
        }
    }

    public function Test()
    {

        $acs = DB::table('article_category')->distinct('article_id')->get();
        foreach($acs as $ac) {
            Article::where('id', $ac->article_id)->update(['category_id' => $ac->category_id]);
        }
    }

    public function CompressorEngine ($src, $dest , $quality)
    {
        $info = getimagesize($src);

        if ($info['mime'] == 'image/jpeg')
        {
            $image = imagecreatefromjpeg($src);
        }
        elseif ($info['mime'] == 'image/gif')
        {
            $image = imagecreatefromgif($src);
        }
        elseif ($info['mime'] == 'image/png')
        {
            $image = imagecreatefrompng($src);
        }
        else
        {
            return $src;
        }

        //compress and save file to jpg
        imagejpeg($image, $dest, $quality);

        //return destination file
        return $dest;
    }

    public function CompressImage($src = "storage/uploads/articles/images/")
    {
        $files = scandir($src);
//        $files = glob("*.*");
//        return $files;
        foreach ($files as $file) {
            if(!is_dir("$src/$file")) {
                echo $file;
//                return storage_path("$src/$file");
                $compressed = $this->CompressorEngine("$src/$file", "$src/$file", 50);
                echo "<pre>item->$compressed compressed.<hr/></pre>";
            }
        }
//        $compressed = $this->CompressorEngine($src, $src, 50);
    }

    public function Vid()
    {
        /*
         * source to help
         * https://github.com/PHP-FFMpeg/PHP-FFMpeg
         * composer require php-ffmpeg/php-ffmpeg
         * https://stackoverflow.com/questions/29916963/laravel-unable-to-load-ffprobe
         * https://stackoverflow.com/questions/16597392/how-do-you-get-the-path-to-the-laravel-storage-folder/16597530
         * */
        $ffmpeg = \FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => env('FFMPEG_BINARIES'),
            'ffprobe.binaries' => env('FFPROBE_BINARIES')
        ]);
        $file = str_replace('storage', '', 'storage\uploads\articles\images\8\دانشگاه-ازاد.mp4');
        $path = Storage::disk('application_public')->path(str_replace('/', DIRECTORY_SEPARATOR, $file));
        $video = $ffmpeg->open($path);
        $frame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(42));
        $frame->save(Storage::disk('application_public')->path('uploads/articles/images/thumbs/thumb.jpg'));
    }

    public function ArchiveEngine(Request $request) {
        $base = 'http://ss.arbazargani.ir';
        if($request->has('version')) {

            $single_version = $request['version'];
            $data = file_get_contents("$base?version=$single_version");
            $dom = new \DomDocument();
            $dom->loadHTML($data);
            $pages = [];
            foreach($dom->getElementsByTagName('a') as $element) {
                $fn = $element->nodeValue;
                $href = $element->getAttribute('href');
                if ( strpos($href, '.pdf') !== false || strpos($href, '.png') !== false || strpos($href, '.jpg') !== false || strpos($href, '.jpeg') !== false )
                    $pages[$href] = $fn;
            }
            asort($pages, SORT_NATURAL);
            $pages = array_chunk($pages, 2);
            // return $pages;
            return view('public.home.newspaper', compact(['request', 'single_version', 'base', 'pages']));

        } else {
            $data = file_get_contents($base);
            $dom = new \DomDocument();
            $dom->loadHTML($data);
            $versions = [];
            foreach($dom->getElementsByTagName('a') as $element) {
                if (is_numeric($element->nodeValue))
                    $versions[] = $element->nodeValue;
            }
            arsort($versions);
            return view('public.home.newspaper', compact(['request', 'versions', 'base']));
        }

    }
}
