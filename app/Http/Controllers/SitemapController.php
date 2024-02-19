<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Page;
use App\Models\Category;
use App\Models\Tag;

class SitemapController extends Controller
{
    public function Index() {
        return response()
            ->view('public.sitemap.index')
            ->header('Content-Type','text/xml');

    }

    public function Article() {
        $articles = Article::where('state', '=', 1)
                            ->where('created_at','<=', Carbon::now())
                            ->whereIn('meta_robots',['nofollow', 'index, follow'])
                            ->latest()->get();
        return response()
            ->view('public.sitemap.article', compact('articles'))
            ->header('Content-Type','text/xml');
    }

    public function Page() {
        $pages = Page::where('state', '=', 1)
                    ->whereIn('meta_robots',['nofollow', 'index, follow'])
                    ->latest()->get();
        return response()
            ->view('public.sitemap.page', compact('pages'))
            ->header('Content-Type','text/xml');
    }

    public function Category() {
        $categories = Category::where('active', '1')->get();
        return response()
            ->view('public.sitemap.category', compact('categories'))
            ->header('Content-Type','text/xml');
    }

    public function Tag() {
        $tags = Tag::latest()->limit(50)->get();
        return response()
            ->view('public.sitemap.tag', compact('tags'))
            ->header('Content-Type','text/xml');
    }
}

