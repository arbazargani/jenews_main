<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function Manage()
    {
        $tags = Tag::paginate(20);
        return view('admin.tag.manage', compact('tags'));
    }

    public function Submit(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:30',
            'slug'=>'max:30'
        ]);
        $tag = new Tag();
        $tag->name = $request['name'];
        if (isset($request['slug']) && !is_null($request['slug'])) {
            $tag->slug = SlugService::createSlug(Tag::class, 'slug', $request['slug']);
        }
        $tag->save();
        return redirect(route('Tag > Manage'));
    }

    public function Delete($id)
    {
        $tag = Tag::find($id)->delete();
        return back();
    }

    public function Archive(Request $request, $slug)
    {
        $tag = Tag::with(['article' => function ($query) {
            $query->where('created_at', '<=', Carbon::now());
        }])->where('slug', '=', $slug)->get();
        if (!count($tag)) {
          return abort('404');
        }

        //handle array of objects pagination

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        // $itemCollection = collect($items);
        $itemCollection = collect($tag[0]->article->where('state', 1)->reverse());

        // Define how many items we want to be visible in each page
        $perPage = 10;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        $PaginatedTags = $paginatedItems;

        return view('public.tag.archive', compact('tag', 'PaginatedTags'));
    }

    public function oldEngine($slug) {
        $tag = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_tags` WHERE `alias` = '$slug'");

        if (!count($tag)) {
            return abort('404');
        } else {
            $tag_id = $tag[0]->id;
        }

        $articles_id = DB::connection('mysql_sec')->select("SELECT DISTINCT `content_item_id` as `id` FROM `smtnw6_contentitem_tag_map` WHERE `tag_id` = '$tag_id' LIMIT 10");

        $articles = [];
        foreach ($articles_id as $article_id) {
            array_push ($articles, DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_content` WHERE `id` = {$article_id->id}")[0]);
        }

//        return $articles;
        return view('old.theme.tag', compact(['tag', 'articles']));
    }

    public function Ajax(Request $request) {
        if ($request->isMethod('get')) {
            if ($request->has('q')) {
                $q = str_replace('[PERSIAN_A]', 'آ', $request->q);
                $result = DB::table('tags')
                ->whereRaw("`slug` LIKE '%" . urldecode($q) . "%'")
                ->orWhereRaw("`name` LIKE '%" . urldecode($q) . "%'")
                // ->whereRaw("`slug` LIKE '%" . $request->q . "%'")
                // ->orWhereRaw("`name` LIKE '%" . $request->q . "%'")
                ->get();
//                echo json_encode($result[0]);
                $result_array = [];
                foreach ($result as $item) {
                    $result_array[] = (object) [
                        'id' => $item->id,
                        'label'=> $item->name,
                        'type' => ['برچسب']
                    ];
                }

                $response = [
                    'request' => $request->fullUrl(),
                    'result' => [
                        'code' => 200,
                        'msg' => 'Success',
                        'list' => $result_array,
                    ],
                ];
                $response = (object) $response;

                return response()->json($response);
            }
        }
    }

    public function AjaxV2(Request $request) {
            $q = $request->search;
            if($q == ''){
               $results = DB::table('tags')->orderby('name','asc')->select('id','name')->limit(5)->get();
            }else{
                $results = DB::table('tags')
                ->whereRaw("`slug` LIKE '%" . urldecode($q) . "%'")
                ->orWhereRaw("`name` LIKE '%" . urldecode($q) . "%'")
                // ->whereRaw("`slug` LIKE '%" . $request->q . "%'")
                // ->orWhereRaw("`name` LIKE '%" . $request->q . "%'")
                ->get();
            }

            $response = array();
            foreach($results as $result){
               $response[] = array(
                    "id"=>$result->id,
                    "text"=>$result->name
               );
            }
            return response()->json($response);
    }
}
