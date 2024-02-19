@extends('public.template')

@section('meta')
	<title>{{ "{$homeTitle->value} {$settings['title_delimiter']->value} {$settings['website_name']->value}" }}</title>
    <meta name="description" content="{{ $homeDescription->value }}">
    <meta name="robots" content="index, follow">
@endsection

@section('content')
    <div class="uk-article">
        <div class="article uk-background-default uk-border-rounded">
            <h1 class="uk-hidden">صفحه اصلی</h1>
            <!-- slider -->
            <div id="slider">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="ratio: 16:9; animation: push; autoplay: true;">
                    <h2 class="uk-hidden">مقالات اخیر</h2>
                    <ul class="uk-slideshow-items uk-border-rounded">
                        @if(isset($level_one_articles[0]))
                            @foreach($level_one_articles[0]->article as $article)
                                @php
                                    $jalaliDate = new Verta($article->created_at);
                                    $jalaliDate->timezone('Asia/Tehran');
                                    $jalaliDate = Verta::instance($article->created_at);
                                    $jalaliDate = Facades\Verta::instance($article->created_at);
                                    $jalaliDate = explode(' ', $jalaliDate);
                                    $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
                                @endphp
                                @php $can_use = true; @endphp
                                @foreach($article->category->all() as $category)
                                    @if($category->id == env('NEWSPAPER_CATEGORY_ID'))
                                        @php $can_use = false; @endphp
                                    @endif
                                @endforeach
                                @if($can_use)
                                    <li>
                                        <img src="{{ $article->cover }}" alt="{{ $article->title }}" uk-cover>
                                        <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-position-fixed uk-text-right uk-transition-slide-bottom">
                                            <h3 uk-slideshow-parallax="x: 100,-100" class="uk-margin-remove uk-visible@m"><a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><span class="uk-icon" uk-icon="arrow-right"></span> {{ $article->title }}</a></h3>
                                            <h3 style="font-size: 13px !important;" uk-slideshow-parallax="x: 100,-100" class="uk-margin-remove uk-align-right uk-hidden@m"><a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}" target="_blank"><span class="uk-icon" uk-icon="arrow-right"></span> {{ $article->title }}</a></h3>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="next"></a>

                </div>
            </div>
            <!-- slider -->

            <hr>

            <!-- Market inventory latest -->
                <div class="container uk-margin-large-bottom">
                    <h2 class="uk-text-lead">آخرین اخبار بازار سرمایه</h2>
                    @if($marketInventory != false)
                        @foreach($marketInventory as $article)
                            @php
                                $jalaliDate = new Verta($article->created_at);
                                $jalaliDate->timezone('Asia/Tehran');
                                $jalaliDate = Verta::instance($article->created_at);
                                $jalaliDate = Facades\Verta::instance($article->created_at);
                                $jalaliDate = explode(' ', $jalaliDate);
                                $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
                            @endphp
                            <div class="uk-card uk-card-small uk-background-muted uk-grid-collapse uk-margin uk-border-rounded">
                                <div>
                                    <div class="uk-card-body" uk-grid>
                                        <div class="uk-width-1-3@m">
                                            <a href="{{ route('Article > Single', $article->slug) }}"><img data-src="{{ $article->cover }}" alt="{{ $article->title }}" class="uk-border-rounded lazy" target="_blank" uk-img></a>
                                        </div>
                                        <div class="uk-width-2-3@m">
                                            <div class="uk-card-badge uk-label uk-background-default uk-text-meta fa-num uk-box-shadow-medium">{{ $jalaliDate }}</div>
                                            <hr>
                                            <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}" target="_blank"><h3 class="uk-h5 uk-width-4-5@m">{{ $article->title }}</h3></a>
                                            @if(count($article->category->all()))
                                                <p class="uk-text-meta">در دسته:
                                                    @foreach($article->category->all() as $category)

                                                        <a class="uk-link-reset" href="{{ route('Category > Archive', $category->slug) }}" target="_blank">{{ $category->name }}</a>
                                                        @if(!$loop->last)
                                                            ،
                                                        @endif
                                                    @endforeach
                                                    @else
                                                        <span class="uk-text-meta">بدون دسته‌بندی</span>
                                                    @endif
                                                </p>
                                                <p class="uk-text-truncate">
                                                    <a href="{{ route('Article > Single', $article->slug) }}" class="uk-badge uk-background-default uk-text-muted uk-float-left" target="_blank"><span uk-icon="arrow-right"></span></a>
                                                    {{ $article->meta_description }}
                                                </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="uk-margin-small">
                        <a href="/category/بازار-سرمایه" target="_blank"><span class="uk-float-left uk-text-meta">بیشتر <span uk-icon="icon: chevron-right"></span></span></a>
                    </div>
                </div>
            <!-- Market inventory latest -->

            <!-- <hr> -->

            <!-- Mine & industry latest -->
            <div class="container uk-margin-large-bottom">
                <h2 class="uk-text-lead">آخرین اخبار صنعت و معدن</h2>
                @if($mineAndIndustry != false)
                @foreach($mineAndIndustry as $article)
                @php
                    $jalaliDate = new Verta($article->created_at);
                    $jalaliDate->timezone('Asia/Tehran');
                    $jalaliDate = Verta::instance($article->created_at);
                    $jalaliDate = Facades\Verta::instance($article->created_at);
                    $jalaliDate = explode(' ', $jalaliDate);
                    $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
                @endphp
                    <div class="uk-card uk-card-small uk-background-muted uk-grid-collapse uk-margin uk-border-rounded">
                        <div>
                            <div class="uk-card-body" uk-grid>
                                <div class="uk-width-1-3@m">
                                    <a href="{{ route('Article > Single', $article->slug) }}"><img data-src="{{ $article->cover }}" alt="{{ $article->title }}" class="uk-border-rounded lazy" target="_blank" uk-img></a>
                                </div>
                                <div class="uk-width-2-3@m">
                                    <div class="uk-card-badge uk-label uk-background-default uk-text-meta fa-num uk-box-shadow-medium">{{ $jalaliDate }}</div>
                                    <hr>
                                    <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}" target="_blank"><h3 class="uk-h5 uk-width-4-5@m">{{ $article->title }}</h3></a>
                                    @if(count($article->category->all()))
                                        <p class="uk-text-meta">در دسته:
                                            @foreach($article->category->all() as $category)

                                                <a class="uk-link-reset" href="{{ route('Category > Archive', $category->slug) }}" target="_blank">{{ $category->name }}</a>
                                                @if(!$loop->last)
                                                    ،
                                                @endif
                                            @endforeach
                                            @else
                                                <span class="uk-text-meta">بدون دسته‌بندی</span>
                                            @endif
                                        </p>
                                        <p class="uk-text-truncate">
                                            <a href="{{ route('Article > Single', $article->slug) }}" class="uk-badge uk-background-default uk-text-muted uk-float-left" target="_blank"><span uk-icon="arrow-right"></span></a>
                                            {{ $article->meta_description }}
                                        </p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <div class="uk-margin-small">
                    <a href="/category/صنعت-و-معدن" target="_blank"><span class="uk-float-left uk-text-meta">بیشتر <span uk-icon="icon: chevron-right"></span></span></a>
                </div>
            </div>
            <!-- Mine & industry latest -->

            <!-- Housing latest -->
            <div class="container uk-margin-large-bottom">
                <h2 class="uk-text-lead">آخرین اخبار مسکن</h2>
                @if($housing != false)
                @foreach($housing as $article)
                @php
                    $jalaliDate = new Verta($article->created_at);
                    $jalaliDate->timezone('Asia/Tehran');
                    $jalaliDate = Verta::instance($article->created_at);
                    $jalaliDate = Facades\Verta::instance($article->created_at);
                    $jalaliDate = explode(' ', $jalaliDate);
                    $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
                @endphp
                    <div class="uk-card uk-card-small uk-background-muted uk-grid-collapse uk-margin uk-border-rounded">
                        <div>
                            <div class="uk-card-body" uk-grid>
                                <div class="uk-width-1-3@m">
                                    <a href="{{ route('Article > Single', $article->slug) }}"><img data-src="{{ $article->cover }}" alt="{{ $article->title }}" class="uk-border-rounded lazy" target="_blank" uk-img></a>
                                </div>
                                <div class="uk-width-2-3@m">
                                    <div class="uk-card-badge uk-label uk-background-default uk-text-meta fa-num uk-box-shadow-medium">{{ $jalaliDate }}</div>
                                    <hr>
                                    <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}" target="_blank"><h3 class="uk-h5 uk-width-4-5@m">{{ $article->title }}</h3></a>
                                    @if(count($article->category->all()))
                                        <p class="uk-text-meta">در دسته:
                                            @foreach($article->category->all() as $category)

                                                <a class="uk-link-reset" href="{{ route('Category > Archive', $category->slug) }}" target="_blank">{{ $category->name }}</a>
                                                @if(!$loop->last)
                                                    ،
                                                @endif
                                            @endforeach
                                            @else
                                                <span class="uk-text-meta">بدون دسته‌بندی</span>
                                            @endif
                                        </p>
                                        <p class="uk-text-truncate">
                                            <a href="{{ route('Article > Single', $article->slug) }}" class="uk-badge uk-background-default uk-text-muted uk-float-left" target="_blank"><span uk-icon="arrow-right"></span></a>
                                            {{ $article->meta_description }}
                                        </p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <div class="uk-margin-small">
                        <a href="/category/مسکن" target="_blank"><span class="uk-float-left uk-text-meta">بیشتر <span uk-icon="icon: chevron-right"></span></span></a>
                    </div>
            </div>
            <!-- Housing latest -->

            <!-- Exchange latest -->
            <div class="container uk-margin-large-bottom">
                <h2 class="uk-text-lead">آخرین اخبار بورس</h2>
                @if($exchange != false)
                @foreach($exchange as $article)
                @php
                    $jalaliDate = new Verta($article->created_at);
                    $jalaliDate->timezone('Asia/Tehran');
                    $jalaliDate = Verta::instance($article->created_at);
                    $jalaliDate = Facades\Verta::instance($article->created_at);
                    $jalaliDate = explode(' ', $jalaliDate);
                    $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
                @endphp
                    <div class="uk-card uk-card-small uk-background-muted uk-grid-collapse uk-margin uk-border-rounded">
                        <div>
                            <div class="uk-card-body" uk-grid>
                                <div class="uk-width-1-3@m">
                                    <a href="{{ route('Article > Single', $article->slug) }}" target="_blank"><img data-src="{{ $article->cover }}" alt="{{ $article->title }}" class="uk-border-rounded lazy" uk-img></a>
                                </div>
                                <div class="uk-width-2-3@m">
                                    <div class="uk-card-badge uk-label uk-background-default uk-text-meta fa-num uk-box-shadow-medium">{{ $jalaliDate }}</div>
                                    <hr>
                                    <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}" target="_blank"><h3 class="uk-h5 uk-width-4-5@m">{{ $article->title }}</h3></a>
                                    @if(count($article->category->all()))
                                        <p class="uk-text-meta">در دسته:
                                            @foreach($article->category->all() as $category)

                                                <a class="uk-link-reset" href="{{ route('Category > Archive', $category->slug) }}" target="_blank">{{ $category->name }}</a>
                                                @if(!$loop->last)
                                                    ،
                                                @endif
                                            @endforeach
                                            @else
                                                <span class="uk-text-meta">بدون دسته‌بندی</span>
                                            @endif
                                        </p>
                                        <p class="uk-text-truncate">
                                            <a href="{{ route('Article > Single', $article->slug) }}" class="uk-badge uk-background-default uk-text-muted uk-float-left" target="_blank"><span uk-icon="arrow-right"></span></a>
                                            {{ $article->meta_description }}
                                        </p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <div class="uk-margin-small">
                    <a href="/category/بورس" target="_blank"><span class="uk-float-left uk-text-meta">بیشتر <span uk-icon="icon: chevron-right"></span></span></a>
                </div>
            </div>
            <!-- Exchange latest -->

            <!-- Technology latest -->
            <div class="container uk-margin-large-bottom">
                <h2 class="uk-text-lead">آخرین اخبار فناوری</h2>
                @if($technology != false)
                @foreach($technology as $article)
                @php
                    $jalaliDate = new Verta($article->created_at);
                    $jalaliDate->timezone('Asia/Tehran');
                    $jalaliDate = Verta::instance($article->created_at);
                    $jalaliDate = Facades\Verta::instance($article->created_at);
                    $jalaliDate = explode(' ', $jalaliDate);
                    $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
                @endphp
                    <div class="uk-card uk-card-small uk-background-muted uk-grid-collapse uk-margin uk-border-rounded">
                        <div>
                            <div class="uk-card-body" uk-grid>
                                <div class="uk-width-1-3@m">
                                    <a href="{{ route('Article > Single', $article->slug) }}" target="_blank"><img data-src="{{ $article->cover }}" alt="{{ $article->title }}" class="uk-border-rounded lazy" uk-img></a>
                                </div>
                                <div class="uk-width-2-3@m">
                                    <div class="uk-card-badge uk-label uk-background-default uk-text-meta fa-num uk-box-shadow-medium">{{ $jalaliDate }}</div>
                                    <hr>
                                    <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}" target="_blank"><h3 class="uk-h5 uk-width-4-5@m">{{ $article->title }}</h3></a>
                                    @if(count($article->category->all()))
                                        <p class="uk-text-meta">در دسته:
                                            @foreach($article->category->all() as $category)

                                                <a class="uk-link-reset" href="{{ route('Category > Archive', $category->slug) }}" target="_blank">{{ $category->name }}</a>
                                                @if(!$loop->last)
                                                    ،
                                                @endif
                                            @endforeach
                                            @else
                                                <span class="uk-text-meta">بدون دسته‌بندی</span>
                                            @endif
                                        </p>
                                        <p class="uk-text-truncate">
                                            <a href="{{ route('Article > Single', $article->slug) }}" class="uk-badge uk-background-default uk-text-muted uk-float-left" target="_blank"><span uk-icon="arrow-right"></span></a>
                                            {{ $article->meta_description }}
                                        </p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <div class="uk-margin-small">
                    <a href="/category/فناوری" target="_blank"><span class="uk-float-left uk-text-meta">بیشتر <span uk-icon="icon: chevron-right"></span></span></a>
                </div>
            </div>
            <!-- Technology latest -->

        </div>
    </div>
@endsection
