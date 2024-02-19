@if(count($leadArticle))
@foreach($leadArticle[0]->article as $article)
@php
    $jalaliDate = new Verta($article->created_at);
    $jalaliDate->timezone('Asia/Tehran');
    $jalaliDate = Verta::instance($article->created_at);
    $jalaliDate = Facades\Verta::instance($article->created_at);
    $jalaliDate = explode(' ', $jalaliDate);
    $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
@endphp
    <div class="uk-width-1-1@m uk-margin-small-bottom uk-text-center">
        <a href="{{ route('Article > Single', $article->slug) }}"><img src="{{ $article->cover }}" alt="{{ $article->title }}" class="uk-border-rounded" uk-img></a>
    </div>
    <a class="uk-link-reset uk-text-meta uk-card-title fa-num">{{ $jalaliDate }}</a>
    <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><h4 class="uk-h5" style="font-weight: 900; font-size: 1.3em !important; color: #019541 !important;">{{ $article->title }}</h4></a>
@endforeach
@endif
