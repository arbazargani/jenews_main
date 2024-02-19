@extends('public.sitemap')

@section('content')

<url>

    <loc>{{ urldecode(route('Home')) }}</loc>

    <lastmod>{{ date('Y-m-d H:i:s') }}</lastmod>

    <changefreq>monthly</changefreq>

    <priority>1.0</priority>
</url>

@if(count($pages) > 0)
@foreach($pages as $page)
<url>

    <loc>{{ urldecode(route('Page > Single', $page->slug)) }}</loc>

{{--    <lastmod>{{ $page->updated_at }}</lastmod>--}}
    <lastmod>{{ gmdate('Y-m-d\TH:i:s+00:00', strtotime($page->updated_at)) }}</lastmod>

    <changefreq>hourly</changefreq>

    <priority>0.9</priority>
    @if($page->cover)
    <image:image>
        <image:loc>{{ ($page->cover != 'ghost.png' && !is_null($article->cover)) ? $page->cover : env('SITE_URL') . '/assets/image/ghost.png' }}</image:loc>
        <image:caption>{{ $page->title }}</image:caption>
        <image:title>{{ $page->title }}</image:title>
    </image:image>
    @endif

</url>
@endforeach
@endif

@endsection
