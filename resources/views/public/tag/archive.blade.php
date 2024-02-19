@extends('public.template')

@section('meta')
    <title>{{ 'آرشیو برچسب ' . $tag[0]->name . ' ' . $settings['title_delimiter']->value . ' ' . $settings['website_name']->value }}</title>
    <meta name="description" content="آرشیو برچسب ‌{{ $tag[0]->name }}">
    <meta name="robots" content="index, follow">
@endsection

@section('content')

<!-- breadcrumbs -->
<ul class="uk-breadcrumb uk-margin-medium-right">
    <li><a href="{{ route('Home') }}">خانه</a></li>
    <li class="uk-disabled"><a>برچسب</a></li>
    <li><a href="{{ route('Tag > Archive', $tag[0]->slug) }}">{{ $tag[0]->name }}</a></li>
    <li class="uk-disabled"><a>آرشیو</a></li>
</ul>
<!-- breadcrumbs -->

<!-- content -->
<div class="uk-article">
            <h1 class="uk-text-lead">{{ 'آرشیو برچسب: ' . $tag[0]->name }}</h1>
            <hr>
            @if(count($PaginatedTags))
            @foreach($PaginatedTags as $article)
            @php
                $jalaliDate = new Verta($article->created_at);
                $jalaliDate->timezone('Asia/Tehran');
                $jalaliDate = Verta::instance($article->created_at);
                $jalaliDate = Facades\Verta::instance($article->created_at);
                $jalaliDate = explode(' ', $jalaliDate);
                $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
            @endphp
            <div class="article uk-margin @if($loop->even) uk-background-default @else uk-background-secondary uk-light @endif uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-large">
                <div class="uk-container" uk-grid>
                    <div class="uk-width-1-3@m">
                        <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}">

                            @if(strpos($article->cover, 'ghost.png') !== false || is_null($article->cover))
                                <img class="3 uk-border-rounded" src="/assets/image/ghost.png" style="width: auto">
                            @else
                                @if($article->type == 'video')
                                    <img class="4 uk-border-rounded" src="/storage/{{ $article->cover }}" style="width: auto;">
                                @else
                                    <img class="4 uk-border-rounded" src="{{ $article->cover }}" style="width: auto;">
                                @endif
                            @endif
                        </a>
                    </div>
                    <div class="uk-width-2-3@m">
                        <p>
                            <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><h3 class="uk-margin-small-top uk-margin-small-bottom uk-text-lead">{{ $article->title }}</h3></a>
                            <span class="uk-text-meta fa-num"><span uk-icon="clock" class="uk-margin-small-left"></span> {{ $jalaliDate }}</span>
{{--                            <hr class="uk-divider-small">--}}
                            <div uk-grid>
                                <div class="uk-width-5-6">
                                    <p class="uk-text-truncate">
                                        <span>{{ $article->meta_description }}</span>
                                    </p>
                                </div>

                                <div class="uk-width-1-6">
                                    <a class="uk-bage uk-badge" href="{{ route('Article > Single', $article->slug) }}"><span uk-icon="arrow-right"></span></a>
                                </div>
                            </div>

                        </p>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- paginator -->
            {{ $PaginatedTags->links("pagination::uikit") }}
            <!-- paginator -->

            @else
            <div class="article uk-margin uk-background-default uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-large">
                <div class="uk-container uk-padding-remove">
                    <div class="uk-alert uk-alert-warning">
                        <p>نوشته‌ای در این برچسب وجود ندارد</p>
                    </div>
                </div>
            </div>
            @endif

        </div>
<!-- content -->


@endsection
