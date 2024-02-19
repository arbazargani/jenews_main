@extends('public.sitemap')

@section('content')

@foreach($articles as $article)
<url>

    <loc>{{ urldecode(route('Article > Single', $article->slug)) }}</loc>

{{--    <lastmod>{{  $article->updated_at }}</lastmod>--}}
    <lastmod>{{ gmdate('Y-m-d\TH:i:s+00:00', strtotime($article->updated_at)) }}</lastmod>

    <changefreq>hourly</changefreq>

    <priority>0.9</priority>

    <image:image>
        <image:loc>{{ ($article->cover != 'ghost.png' && !is_null($article->cover)) ? $article->cover : env('SITE_URL') . '/assets/image/ghost.png' }}</image:loc>
        <image:caption>{{ $article->title }}</image:caption>
        <image:title>{{ $article->title }}</image:title>
    </image:image>

</url>
@endforeach

@endsection
