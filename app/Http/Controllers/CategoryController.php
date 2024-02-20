<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function Manage()
    {
        $categories = Category::paginate(15);
        return view('admin.category.manage', compact('categories'));
    }

    public function Submit(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:30',
            'slug'=>'max:30'
        ]);
        $category = new Category();
        $category->name = $request['name'];
        $category->parent = ($request->has('parent') && !empty($request['parent'])) ? $request['parent'] : '-1';
        if (isset($request['slug']) && !is_null($request['slug'])) {
            $category->slug = SlugService::createSlug(Category::class, 'slug', $request['slug']);
        }
        $category->save();
        return redirect(route('Category > Manage'));
    }

    public function Delete($id)
    {
        if ($id == 1) {
            $back = route('Category > Manage');
            return view('admin.errors.unallowed', compact('back'));
        }
        $category = Category::find($id)->delete();
        return back();
    }

    public function Archive_deprecated(Request $request, $slug)
    {
        // $category = Category::with('article')->where('slug', '=', $slug)->get();
        $category = Category::with('article')->where('slug', '=', $slug)->get();
        $category = Category::with(['article' => function ($query) {
                    $query->where('created_at', '<=', Carbon::now());
        }])->where('slug', '=', $slug)->get();
        if (!count($category)) {
          return abort('404');
        }

        //handle array of objects pagination

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        // $itemCollection = collect($items);
        $itemCollection = collect($category[0]->article->where('state', 1)->reverse());

        // Define how many items we want to be visible in each page
        $perPage = 15;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        $PaginatedCategories = $paginatedItems;

        return view('public.category.archive', compact('category', 'PaginatedCategories'));
    }

    public function Archive(Request $request, $slug) {
        $category = Category::whereSlug($slug)->firstOrFail();
        $PaginatedCategories = Article::where('category_id', $category->id)
            ->where('state', 1)
            ->where('created_at', '<=', Carbon::now())
            ->latest()->paginate(35);
        return view('public.category.archive', compact('category', 'PaginatedCategories'));
    }

/*
    public function oldEngine($slug) {
        $tag = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_categories` WHERE `alias` = '$slug'");

        if (!count($tag)) {
            return abort('404');
        } else {
            $category_id = $tag[0]->id;
        };

        $articles = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_content` WHERE `catid` = 'category_id' LIMIT 10");

        return $articles;
    }
*/
    public function OldEngineSimple ($param_1) {
        $category = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_categories` WHERE `alias` = '$param_1'");
//        return $param_1;

        if (!count($category)) {
            return abort('404');
        } else {
            $category_id = $category[0]->id;
        };

        $articles = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_content` WHERE `catid` = $category_id LIMIT 10");

        // return (object) $article_info;
        // return $articles;
        // die('408');
        return view('old.theme.archive', compact(['category', 'articles']));

    }

    public function OldEngineComplex ($param_2) {
        $category = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_categories` WHERE `alias` = '$param_2'");

        if (!count($category)) {
            return abort('404');
        } else {
            $category_id = $category[0]->id;
        };

        $articles = DB::connection('mysql_sec')->select("SELECT * FROM `smtnw6_content` WHERE `catid` = $category_id LIMIT 10");

        // return (object) $article_info;
        // return $articles;
        // return $category[0]->path;
        return view('old.theme.archive', compact(['category', 'articles']));
    }
}
