<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;

class FeedController extends Controller
{
    public function Index() {
        // $articles = Article::where('state', '=', 1)->get();
        $articles = Article::where('state', '=', 1)
                            ->where('created_at','<=', Carbon::now())
                            ->orderBy('id', 'DESC')->limit(30)->get();
        $lastModified = $articles->first();
        return response()
        ->view('public.feed.index', compact(['articles', 'lastModified']))
        ->header('Content-Type','application/atom+xml; charset=UTF-8');
    }

    public function V2() {
        // $articles = Article::where('state', '=', 1)->get();
        $articles = Article::where('state', '=', 1)
                            ->where('created_at','<=', Carbon::now())
                            ->orderBy('id', 'DESC')->limit(30)->get();
        $lastModified = $articles->first();
        return response()
        ->view('public.feed.v2', compact(['articles', 'lastModified']))
        ->header('Content-Type','application/atom+xml; charset=UTF-8');
    }
    
    public function Category($slug) {
        $category = Category::with(['article' => function ($query) {
                $query->where('state', '=',1)
                    ->where('created_at', '<=', Carbon::now())
                ->orderBy('id', 'DESC');
        }])->where('slug', '=', $slug)->firstOrFail();

        $articles = $category->article;
        $lastModified = $category->article->first();
        return response()
        ->view('public.feed.v2', compact(['articles', 'lastModified']))
        ->header('Content-Type','application/atom+xml; charset=UTF-8');
    }

    public function Latest() {
        $articles = Article::where('state', '=', 1)
                ->where('created_at','<=', Carbon::now())
                ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
                ->orderBy('id', 'DESC')->limit(30)->get();
        $lastModified = $articles->first();
        return response()
        ->view('public.feed.v2', compact(['articles', 'lastModified']))
        ->header('Content-Type','application/atom+xml; charset=UTF-8');
    }

    public function LatestTop() {
        $articles = Article::where('state', '=', 1)
        ->where('created_at','<=', Carbon::now())
        ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
        ->orderBy('views', 'DESC')->limit(30)->get();
        $lastModified = $articles->first();
        return response()
        ->view('public.feed.v2', compact(['articles', 'lastModified']))
        ->header('Content-Type','application/atom+xml; charset=UTF-8');
    }

}