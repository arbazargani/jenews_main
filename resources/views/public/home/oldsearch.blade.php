@extends('public.template')

@section('meta')
<title>{{ 'نتایج جستجو' . " " . $settings['title_delimiter']->value . " " . $settings['website_name']->value }}</title>
    <meta name="description" content="{{ 'نتایج جستجو'}}">
    <meta name="robots" content="index, follow">
@endsection

@section('content')
<ul class="uk-breadcrumb uk-margin-medium-right">
    <li><a href="{{ route('Home') }}">خانه</a></li>
    <li class="uk-disabled"><a>نتایج جستجو</a></li>
    @if(isset($_GET['query']))
    <li class="uk-disabled"><a>{{ $_REQUEST['query'] }}</a></li>
    @endif
</ul>
<div class="uk-padding-small" uk-grid>
    <div class="uk-article uk-width-1-1@m">
        <article class="article uk-padding">
            <!-- socket - search -->
            <div class="uk-card uk-card-hover uk-card-body">
                <!-- <h3 class="uk-card-title uk-text-meta">جستجو</h3> -->
                <!-- <hr class="uk-divider-small"> -->
                <form class="uk-grid-small" action="{{ route('Old Search') }}" uk-grid>
                    <div class="uk-width-3-4@m">
                        <input class="uk-input" type="text" name="query" id="query" placeholder="جستجو در اخبار قدیمی">
                    </div>
                    <div class="uk-width-1-4@m">
                        <button class="uk-button uk-button-primary theme-background-green" type="submit"><span uk-icon="search"></span></button>
                    </div>
                </form>
            </div>
            <!-- socket - search -->
            @if(isset($_GET['query']))
            <h1 class="uk-text-lead">{{ 'نتایج جستجو: ' . $_REQUEST['query'] }}</h1>
            @endif
            <hr>
            @if($articles !== false && count($articles) !== 0)
                <div class="uk-child-width-1-2@m" uk-grid="masonry: true" uk-grid>
                    @foreach ($articles as $article)
                    <div>
                        <div class="uk-card uk-card-default uk-card-hover uk-border-rounded">
                            <div class="uk-card-media-top">
                                <img src="{{ asset('assets/image/ghost.png') }}" alt="">
                            </div>
                            <div class="uk-card-body">
                                @php
                                    $jalaliDate = new Verta($article->post_date);
                                    $jalaliDate->timezone('Asia/Tehran');
                                    $jalaliDate = Verta::instance($article->post_date);
                                    $jalaliDate = Facades\Verta::instance($article->post_date);
                                @endphp
                                <h2 class="uk-card-title uk-text-default"><a href="/{{ $article->post_name }}" class="uk-link-heading fa-kit-medium">{{ $article->post_title }}</a></h2>
                                <p class="uk-text-meta uk-margin-remove-top"><time class="fa-num" datetime="{{ $article->post_date_gmt }}">{{ $jalaliDate }}</time></p>
                            </div>
                            <a class="uk-button uk-button-primary theme-background-green" style="width: 100%; border-radius: 0px 0px 5px 5px;" href="{{ route('Old cms > News > Simple', $article->post_name) }}">بازدید</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="uk-alert-warning" uk-alert>
                    <p>جستجوی شما نتیجه‌ای نداشت.</p>
                </div>
            @endif

            @if(isset($_GET['query']))
            <hr>
            <?php
                $prev = (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page']-1 : '1';
                $next = (isset($_GET['page']) && $_GET['page'] == 1) ? $_GET['page']+1 : 1;
                $next = (!isset($_GET['page'])) ? 2 : $_GET['page']+1;
            ?>
            <div class="uk-container">
                <ul class="uk-pagination">
                    <li><a href="?query={{ $_GET['query'] }}&page={{ $prev }}"><span class="uk-margin-small-right" uk-pagination-previous></span> قبل</a></li>
                    <li class="uk-margin-auto-left uk-float-left"><a href="?query={{ $_GET['query'] }}&page={{ $next }}">بعد <span class="uk-margin-small-left" uk-pagination-next></span></a></li>
                </ul>
            </div>
            @endif
        </article>
    </div>
</div>
@endsection
