@extends('public.template')

@section('meta')
	<title>روزنامه صمت - آرشیو اخبار کامل</title>
    <meta name="description" content="آرشیو کامل اخبار روزنامه صمت">
    <meta name="robots" content="index, follow">
@endsection

@section('content')
<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-1">
        <h2 class="uk-card-title">آرشیو تمام اخبار</h2>
        <ul class="uk-list uk-list-disc uk-list-muted">    
        @foreach($articles as $article)
            <li><a target="_blank" href="{{ route('Article > Single', $article->slug) }}">{{ $article->title }}</a></li>
        @endforeach
        </ul>
        <div class="uk-container uk-padding">
        <!-- paginator -->
        {{ $articles->links('pagination::uikit-simple') }}
        <!-- paginator -->
        </div>
    </div>
</div>
@endsection