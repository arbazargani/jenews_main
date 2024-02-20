@extends('public.template')

@section('meta')
    <title>{{ 'آرشیو دسته ' . $category->name . ' ' . $settings['title_delimiter']->value . ' ' . $settings['website_name']->value }}</title>
    <meta name="description" content="آرشیو دسته ‌{{ $category->name }}">
    <meta name="robots" content="index, follow">
@endsection

@section('content')
<!-- breadcrumbs -->
<ul class="uk-breadcrumb uk-margin-medium-right">
    <li><a href="{{ route('Home') }}">خانه</a></li>
    <li class="uk-disabled"><a>دسته</a></li>
    <li><a href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a></li>
    <li class="uk-disabled"><a>آرشیو</a></li>
</ul>
<!-- breadcrumbs -->

<!-- content -->
<div class="uk-article">
            <h1 class="uk-text-lead">{{ 'آرشیو دسته: ' . $category->name }}</h1>
            <hr>
            @if(count($PaginatedCategories))
            @foreach($PaginatedCategories as $article)
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
                            @if($category->id == env('NEWSPAPER_CATEGORY_ID'))
                            <img loading="lazy" class="1 uk-border-rounded" src="{{ env('SITE_URL')."/repository/".strip_tags($article->content)."/frontpage_".strip_tags($article->content).".jpg" }}" style="width: auto;">
                            @elseif(strpos($article->cover, 'ghost.png') !== false || is_null($article->cover))
                            <img loading="lazy" class="3 uk-border-rounded" src="/assets/image/ghost.png" style="width: auto">
                            @else
                                @if($article->type == 'video')
                                    <img loading="lazy" class="4 uk-border-rounded" src="/storage/{{ $article->cover }}" style="width: auto;">
                                @else
                                    <img loading="lazy" class="4 uk-border-rounded" src="{{ $article->cover }}" style="width: auto;">
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
            {{ $PaginatedCategories->links("pagination::uikit") }}
            <!-- paginator -->

            @else
            <div class="article uk-margin uk-background-default uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-large">
                <div class="uk-container uk-padding-remove">
                    <div class="uk-alert uk-alert-warning">
                        <p>نوشته‌ای در این دسته وجود ندارد</p>
                    </div>
                </div>
            </div>
            @endif

            @if($category->id == env('NEWSPAPER_CATEGORY_ID'))
                @php
                    $dir = 'repository';
                    $versions = new \App\Http\Controllers\NewspaperController();
                    $versions = $versions->ListDir();
                @endphp
                    @foreach ($versions as $version)
                        @if($version !== '.' && $version !== '..' && $version !== '.ftpquota' && $version !== 'final.php')
                    <div class="article uk-margin uk-background-default uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-large">
                        <div class="uk-container" uk-grid>
                            <div class="uk-width-1-3@m">
                                <a class="uk-link-reset" href=""><img loading="lazy" class="uk-border-rounded" src="/repository/{{ $version }}/frontpage_{{ $version }}.jpg" style="width: auto;"></a>
                            </div>
                            <div class="uk-width-2-3@m">
                                <p>
                                    <a class="uk-link-reset" href=""><h3 class="uk-margin-small-top uk-margin-small-bottom uk-text-lead">روزنامه صمت شماره {{ $version }}</h3></a>
    {{--                            <span class="uk-text-meta fa-num"><span uk-icon="clock" class="uk-margin-small-left"></span> {{ $jalaliDate }}</span>--}}
                                {{--                            <hr class="uk-divider-small">--}}
                                <div uk-grid>
                                    <div class="uk-width-5-6">
                                        <p class="uk-text-truncate">
    {{--                                        <span>{{ $article->meta_description }}</span>--}}
                                        </p>
                                    </div>

                                    <div class="uk-width-1-6">
                                        <a class="uk-bage uk-badge" href="{{ route('Newspaper > Download') }}?version={{$version}}">دانلود <span uk-icon="arrow-right"></span></a>
                                    </div>
                                </div>

                                </p>
                            </div>
                        </div>
                    </div>
                        @endif
                    @endforeach
                <div class="uk-container">
                    @php
                        if(isset($_GET['page']) && !is_null($_GET['page'])) {
                            $page = (int) $_GET['page'];
                            $next_page = $page+1;
                            $prev_page = $page-1;
                        } else {
                            $next_page = 1;
                            $prev_page = 2;
                        }
                    @endphp
{{--                    <a class="uk-float-right" href="{{ ($prev_page) ? "?page=$next_page" : "" }}"><span class="uk-margin-small-right" uk-pagination-previous></span> قبل</a>--}}
{{--                    <a class="uk-float-left" href="{{ ($next_page) ? "?page=$prev_page" : "" }}">بعد <span class="uk-margin-small-left" uk-pagination-next></span></a>--}}
                </div>
            @endif
        </div>
<!-- content -->

@endsection
