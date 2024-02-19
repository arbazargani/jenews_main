@extends('public.sitemap')

@section('content')

<url>

    <loc>{{ route('Home') }}</loc>

    <lastmod>{{ gmdate('Y-m-d\TH:i:s+00:00', strtotime(date('Y-m-d H:i:s'))) }}</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Articles') }}</loc>

    <lastmod>{{ gmdate('Y-m-d\TH:i:s+00:00', strtotime(App\Models\Article::latest()->take(1)->first()->updated_at)) }}</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Pages') }}</loc>

    <lastmod>{{ gmdate('Y-m-d\TH:i:s+00:00', strtotime(App\Models\Page::latest()->first()->updated_at )) }}</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Categories') }}</loc>

    <lastmod>{{ gmdate('Y-m-d\TH:i:s+00:00', strtotime(App\Models\Category::latest()->take(1)->first()->created_at)) }}</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

<url>

    <loc>{{ route('Sitemap > Tags') }}</loc>

    <lastmod>{{ gmdate('Y-m-d\TH:i:s+00:00', strtotime(App\Models\Tag::latest()->take(1)->first()->created_at)) }}</lastmod>

    <changefreq>monthly</changefreq>

    <priority>0.8</priority>

</url>

@endsection
