<?php

namespace App\Providers;

use App\Models\Advertise;
use App\Models\Article;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') == 'production') {
            \URL::forceScheme('https');
        }


        if (env('APP_ENV') == 'build') {
            return;
        }


        $date = date("Y-m-d H:i:s");


        if (Cache::has('categories')) {
            $categories = Cache::get('categories');
        } else {
            $categories = Category::where('id', '!=', 1)->where('created_at', '<=', Carbon::now())->get();
            Cache::put('categories', $categories, now()->addDays(2));

        }


        if (Cache::has('newspaper_latest')) {
            $newspaper_latest = Cache::get('newspaper_latest');
        } else {
            // $newspaper_latest = Category::where('slug', 'آرشیو-روزنامه')->with(['article' => function($query) {
            //     $query->where('cover', '!=', 'ghost.png')
            //         ->where('created_at', '<=', Carbon::now())
            //         ->limit(1)
            //         ->latest();
            // }])->first()->article()->first();
            $newspaper_latest = Category::find(480)->article()->latest()->first();
            Cache::put('newspaper_latest', $newspaper_latest, now()->addMinutes(5));
        }


        if (Cache::has('latestArticles')) {
            $latestArticles = Cache::get('latestArticles');
        } else {
            $latestArticles = Article::where('created_at', '>=', Carbon::today()->subDays(2))->where('created_at', '<=', Carbon::now())->where('state', 1)->limit(20)->latest()->get();
            Cache::put('latestArticles', $latestArticles, now()->addMinutes(5));
        }


        if (Cache::has('popularArticles')) {
            $popularArticles = Cache::get('popularArticles');
        } else {
            $popularArticles = Article::where('state', 1)->where('created_at', '<=', Carbon::now())
                ->whereNotIn('cover', ['', 'ghost.png'])
                ->where('created_at', '<=', Carbon::now())
                ->whereBetween('created_at', [Carbon::now()->subDays(1), Carbon::now()])->orderBy('views', 'desc')->limit(20)->get();
            Cache::put('popularArticles', $popularArticles, now()->addHour(1));
        }


        if (Cache::has('notPopularArticles')) {
            $notPopularArticles = Cache::get('notPopularArticles');
        } else {
            $notPopularArticles = Article::where('state', 1)->where('created_at', '<=', Carbon::now())->whereBetween('created_at', [Carbon::now()->subDays(1), Carbon::now()])->orderBy('views', 'asc')->limit(20)->get();
            Cache::put('notPopularArticles', $notPopularArticles, now()->addHour(1));
        }


        if (Cache::has('ceoNotes')) {
            $ceoNotes = Cache::get('ceoNotes');
        } else {
            $ceoNotes = Category::where('slug', 'یادداشت-مدیرمسئول')->with(['article' => function ($query) {
                $query->where('cover', '!=', 'ghost.png')
                    ->where('created_at', '<=', Carbon::now())
                    ->limit(1)
                    ->latest();
            }])->get();
            Cache::put('ceoNotes', $ceoNotes, now()->addMinutes(5));
        }


        if (Cache::has('leadArticle')) {
            $leadArticle = Cache::get('leadArticle');
        } else {
            $leadArticle = Category::where('slug', 'سرمقاله')->with(['article' => function ($query) {
                $query->where('cover', '!=', 'ghost.png')
                    ->where('created_at', '<=', Carbon::now())
                    ->limit(1)
                    ->latest();
            }])->get();
            Cache::put('leadArticle', $leadArticle, now()->addMinutes(5));
        }


        if (Cache::has('advertises')) {
            $advertises = Cache::get('advertises');
        } else {
            $advertises = Advertise::where('state', 1)->get();
            Cache::put('advertises', $advertises, now()->addHour(5));
        }


        if (Cache::has('website_name')) {
            $settings['website_name'] = Cache::get('website_name');
        } else {
            $settings['website_name'] = Setting::where('name', 'website_name')->first();
            Cache::put('website_name', $settings['website_name'], now()->addDays(2));
        }


        if (Cache::has('title_delimiter')) {
            $settings['title_delimiter'] = Cache::get('title_delimiter');
        } else {
            $settings['title_delimiter'] = Setting::where('name', 'title_delimiter')->first();
            Cache::put('title_delimiter', $settings['title_delimiter'], now()->addDays(2));
        }


        if (Cache::has('logo_src')) {
            $settings['logo_src'] = Cache::get('logo_src');
        } else {
            $settings['logo_src'] = Setting::where('name', 'logo_src')->first();
            Cache::put('logo_src', $settings['logo_src'], now()->addDays(2));
        }


        if (Cache::has('before_body_codes')) {
            $settings['before_body_codes'] = Cache::get('before_body_codes');
        } else {
            $settings['before_body_codes'] = Setting::where('name', 'before_body_codes')->first();
            Cache::put('before_body_codes', $settings['before_body_codes'], now()->addDays(2));
        }


        if (Cache::has('end_body_codes')) {
            $settings['end_body_codes'] = Cache::get('end_body_codes');
        } else {
            $settings['end_body_codes'] = Setting::where('name', 'end_body_codes')->first();
            Cache::put('end_body_codes', $settings['end_body_codes'], now()->addDays(2));
        }


        if (Cache::has('site_down')) {
            $settings['site_down'] = Cache::get('site_down');
        } else {
            $settings['site_down'] = Setting::where('name', 'site_down')->first();
            Cache::put('site_down', $settings['site_down'], now()->addDays(2));
        }


        if (Cache::has('menu_structure')) {
            $settings['menu_structure'] = Cache::get('menu_structure');
        } else {
            $settings['menu_structure'] = Setting::where('name', 'menu_structure')->first();
            Cache::put('menu_structure', $settings['menu_structure'], now()->addDays(2));
        }


        if (Cache::has('special_archive')) {
            $settings['special_archive'] = Cache::get('special_archive');
        } else {
            $settings['special_archive'] = Setting::where('name', 'special_archive')->first();
            Cache::put('special_archive', $settings['special_archive'], now()->addDays(2));
        }


        view()->share(compact([
            'latestArticles',
            'categories',
            'newspaper_latest',
            'settings',
            'notPopularArticles',
            'popularArticles',
            'ceoNotes',
            'leadArticle',
            'advertises'
        ]));
    }
}
