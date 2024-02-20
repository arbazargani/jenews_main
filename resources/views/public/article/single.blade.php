@extends('public.template')

@section('meta')
    <title>{{ $article[0]->title . ' ' . $settings['title_delimiter']->value . ' ' . $settings['website_name']->value }}</title>
    @if(!is_null($article[0]->meta_description))
        <meta name="description" content="{{ $article[0]->meta_description }}">
    @endif
    @if(!is_null($article[0]->meta_robots))
        <meta name="robots" content="{{ $article[0]->meta_robots }}">
    @endif
    <meta property="og:title" content="{{ $article[0]->title }}">
    <meta property="og:site_name" content="{{ $settings['website_name']->value }}">
    <meta property="og:description" content="{{ $article[0]->meta_description }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('Article > Single', $article[0]->slug) }}">
    <meta property="og:image" content="{{ $article[0]->cover }}">
    <meta name="twitter:site" content="{{ route('Article > Single', $article[0]->slug) }}" />
    <meta name="twitter:title" content="{{ $article[0]->title }}" />
    <meta name="twitter:description" content="{{ $article[0]->meta_description }}" />
@endsection

@section('content')
    @php
        $showMainMetaBox = true;
    @endphp
    <ul class="uk-breadcrumb" style="
                                                        text-overflow: ellipsis;
                                                        white-space: nowrap;
                                                        overflow: hidden;
                                                        width: 100%;
                                                        ">
        <li><a href="{{ route('Home') }}">خانه</a></li>
        <li><a href="{{ route('Blog') }}" target="_blank">اخبار</a></li>
        @if(!is_null($article[0]->category) && count($article[0]->category->all()))
            <li>
                <a href="{{ route('Category > Archive', $article[0]->category->first()->slug) }}" target="_blank">{{ $article[0]->category->first()->name }}</a>
            </li>
        @else
            <li><a>بدون دسته‌بندی</a></li>
        @endif
        <li class="uk-disabled"><a>{{ $article[0]->title }}</a></li>
    </ul>

    <article class="article uk-background-default uk-border-rounded">

        <!-- Advertise socket - section 001 -->
        <div class="uk-margin">
            @if(count($advertises) > 0)
                @foreach($advertises->where('socket', 'article-001')->all() as $advertise)
                    @if($advertise->just_admin && !Auth::check())
                        @break
                    @else
                        <div>
                            {!! $advertise->content !!}
                        </div>
                        <hr>
                    @endif
                @endforeach
            @endif
        </div>
        <!-- Advertise socket - section 001 -->

        <!-- Article Code & Date -->
        @php
            $jalaliDate = new Verta($article[0]->created_at);
            $jalaliDate->timezone('Asia/Tehran');
            $jalaliDate = Verta::instance($article[0]->created_at);
            $jalaliDate = Facades\Verta::instance($article[0]->created_at)->format('Y/m/d H:i');
            $jalaliDate = explode(' ', $jalaliDate);
            //$jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
        @endphp
        <div class="theme-background-green uk-margin-small-bottom" style="padding: 1% 2%; border-radius: 3px; height: 20px">
            <span class="uk-text-meta uk-text-bold uk-float-right" style="color: white !important;">کدخبر: {{ $article[0]->id }}</span>
            <span class="uk-text-meta uk-text-bold uk-float-left" style="color: white !important; direction: ltr"><span uk-icon="icon: clock; ratio: 0.7"></span> {{ $jalaliDate[1] }}</span>
            <span class="uk-text-meta uk-text-bold uk-float-left uk-margin-small-left" style="color: white !important; direction: ltr"><span uk-icon="icon: calendar; ratio: 0.7"></span> {{ $jalaliDate[0] }}</span>
        </div>
        <!-- Article Code -->



        <!-- article cover and meta box for small-screens -->
        <div class="uk-hidden@m">
            @if($article[0]->cover)
                @if($article[0]->type == 'video')
                    <video style="width: 100%;" id="article-video-sm" class="video-js player" data-plyr-config='{ "title": "{{ $article[0]->title }}" }' controls>
                        <source src="{{ $article[0]->video_url }}">
                        Your browser does not support the video tag.
                    </video>
                    <br>
                    <br>
                @else
                    <img class="uk-align-center uk-border-rounded"
                         src="{{ $article[0]->cover }}"
                         alt="{{ $article['0']->meta_title }}"
                         uk-img>
                @endif
            @endif
            <metabox>
                <div class="uk-container uk-background-muted uk-padding@m uk-border-rounded">
                    <a class="uk-text-meta uk-text-right">{{ $article[0]->rootitr }}</a>
                    <h1 class="uk-margin-top uk-text-lead uk-text-right fa-kit-medium">{{ $article[0]->title }}</h1>
                    <!-- category -->
                    <div style="direction: rtl">
                        <span uk-icon="icon: folder"></span> <span class="uk-text-meta">دسته‌بندی: </span>
                        @if(!is_null($article[0]->category) && count($article[0]->category->all()))
                            @foreach($article[0]->category->all() as $category)
                                <a class="uk-label uk-box-shadow-hover-small uk-background-muted uk-link-reset theme-color-red"
                                   href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a>
                                @if(!$loop->last)
                                    ،
                                @endif
                            @endforeach
                        @else
                            <a class="theme-color-red">بدون دسته‌بندی</a>
                        @endif
                    </div>
                    <!-- category -->
{{--                    <hr/>--}}
                    <!-- date -->
{{--                    <div class="uk-text-center uk-margin-bottom" style="direction: ltr">--}}
{{--                        @php--}}
{{--                            $jalaliDate = new Verta($article[0]->created_at);--}}
{{--                            $jalaliDate->timezone('Asia/Tehran');--}}
{{--                            $jalaliDate = Verta::instance($article[0]->created_at);--}}
{{--                            $jalaliDate = Facades\Verta::instance($article[0]->created_at);--}}
{{--                            $jalaliDate = explode(' ', $jalaliDate);--}}
{{--                            $jalaliDate = $jalaliDate[0] . ' ' . $jalaliDate[1];--}}
{{--                        @endphp--}}
{{--                        <span class="uk-text-meta fa-num"> <span uk-icon="clock"></span> {{ $jalaliDate }}</span>--}}
{{--                    </div>--}}
                    <!-- date -->
                </div>
            </metabox>
        </div>
        <!-- article cover and meta box for small-screens -->

        <!-- article cover and meta box for med/large-screens -->
        {{--    <div class="uk-visible@m">--}}
        <div class="">
            <div>
                <div class="uk-inline uk-width-1-1 check-here uk-visible@m">
                    @if($article[0]->cover == 'ghost.png' || is_null($article[0]->cover))
                        <metabox>
                            <div class="uk-container uk-background-muted uk-padding@m uk-border-rounded">
                                <a class="uk-text-meta uk-text-right">{{ $article[0]->rootitr }}</a>
                                <h1 class="uk-margin-top uk-text-lead uk-text-right fa-kit-medium">{{ $article[0]->title }}</h1>
                            </div>
                        </metabox>
                    @else
                        @if($article[0]->type == 'video')
                            <video style="width: 100%;" id="article-video-lg" class="video-js player" data-plyr-config='{ "title": "{{ $article[0]->title }}" }' controls>
                                <source src="{{ $article[0]->video_url }}">
                                Your browser does not support the video tag.
                            </video>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        @else
                            @php
                                $showMainMetaBox = false;
                            @endphp
                            <div uk-grid>
                                <div class="uk-width-1-3">
                                    <img class="uk-margin-remove uk-align-center uk-border-rounded"
                                         src="{{ $article[0]->cover }}"
                                         alt="{{ $article['0']->meta_title }}" style="min-width: 100%;"
                                         id="cover" uk-img>
                                </div>
                                <div class="uk-width-expand">
                                    <div style="direction: rtl">
                                        <!-- title -->
                                        <div class="uk-padding-remove" uk-grid>
                                            <div class="uk-width-expand">
                                                <a class="uk-text-meta uk-text-right">{{ $article[0]->rootitr }}</a>
                                                <h1 class="uk-text-lead uk-margin-remove">{{ $article[0]->title }}</h1>
                                            </div>
                                        </div>
                                        <!-- title -->
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($showMainMetaBox)
                            <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-border-rounded">
                                <div style="direction: rtl">
                                    <!-- title -->
                                    <div class="uk-padding-remove" uk-grid>
                                        <div>
                                            <span uk-icon="icon: file-text; ratio: 2"></span>
                                        </div>
                                        <div class="uk-width-expand">
                                            <a class="uk-text-meta uk-text-right">{{ $article[0]->rootitr }}</a>
                                            <h1 class="uk-text-lead uk-margin-remove">{{ $article[0]->title }}</h1>
                                        </div>
                                    </div>
                                    <!-- title -->
                                </div>
                            </div>
                        @endif
                </div>
                @endif
            </div>
            <div class="uk-margin-top uk-visible@m">
                <!-- category -->
                <span uk-icon="icon: folder"></span> <span class="uk-text-meta">دسته‌بندی: </span>
                @if(!is_null($article[0]->category) && count($article[0]->category->all()))
                    @foreach($article[0]->category->all() as $category)
                        <a class="uk-label uk-box-shadow-hover-small uk-background-muted uk-link-reset theme-color-red"
                           href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a>
                        @if(!$loop->last)
                            ،
                        @endif
                    @endforeach
                @else
                    <a class="theme-color-red">بدون دسته‌بندی</a>
                @endif
                <!-- category -->

                <!-- date -->
                @php
                    $jalaliDate = new Verta($article[0]->created_at);
                    $jalaliDate->timezone('Asia/Tehran');
                    $jalaliDate = Verta::instance($article[0]->created_at);
                    $jalaliDate = Facades\Verta::instance($article[0]->created_at);
                    $jalaliDate = explode(' ', $jalaliDate);
                    $jalaliDate = $jalaliDate[1] . ' ' . $jalaliDate[0];
                @endphp
{{--                <div class="uk-float-left"><span class="uk-text-meta fa-num"> {{ $jalaliDate }} <span--}}
{{--                            uk-icon="clock"></span></span>--}}
{{--                </div>--}}
                <!-- date -->
            </div>
        </div>
        <!-- article cover and meta box for med/large-screens -->

        <content class="uk-text-justify">
            <div class="uk-margin-medium-top fa-num" id="print_article">
                <div
                    class="uk-container uk-padding uk-margin-small-left uk-margin-small-right uk-background-muted uk-border-rounded">
                    <p>{{ $article[0]->lead }}</p>
                </div>
                @php

                @endphp
                {{-- cover for printing--}}
{{--                <img src="{{ $article[0]->cover }}" style="visibility: hidden; display: none">--}}
                {!! $article[0]->content !!}
                @if($gallery !== false)
                    <div class="uk-position-relative uk-visible-toggle uk-light uk-margin-small" tabindex="-1"
                         uk-slider="center: true">
                        <ul class="uk-slider-items uk-grid">
                            @foreach (explode("|", $gallery) as $url)
                                <li class="uk-width-3-4">
                                    <div class="uk-panel">
                                        <img src="/storage/uploads/gallery/{!! $url !!}" alt="">
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#"
                           uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
                           uk-slider-item="next"></a>

                    </div>
                @endif
            </div>
        </content>

        @if(!$article[0]->is_old_article)
        <metabox>
            <div class="uk-container uk-text-center uk-background-muted uk-padding uk-margin uk-border-rounded">

                @if(!is_null($article[0]->writer) && strlen($article[0]->writer) > 0)
                    <hr class="uk-divider">
                    <span class="uk-text-meta uk-text-bold"><span uk-icon="icon: pencil"></span> نویسنده:  {{ $article[0]->writer }}</span>
                    <hr>
                @endif

                @if(!is_null($article[0]->tag) && count($article[0]->tag->all()) > 0)
                    <span uk-icon="icon: bookmark"></span> <span class="uk-text-meta">برچسب: </span>
                    @if(count($article[0]->tag->all()))
                        @foreach($article[0]->tag->all() as $tag)
                            <a class="uk-label uk-box-shadow-hover-small uk-background-muted uk-link-reset"
                               href="{{ route('Tag > Archive', $tag->slug) }}">{{ $tag->name }}</a>
                            @if(!$loop->last)
                                ،
                            @endif
                        @endforeach
                    @else
                        <a>بدون برچسب</a>
                        @endif
                        </span>
                    @endif

                    <hr>

                    <a class="uk-icon-button" uk-icon="whatsapp" rel="nofollow"
                       href="whatsapp://send?text={{ urldecode(urlencode(route('Article > Single', $article[0]->slug))) }}"
                       target="_blank"></a>

                    <a class="uk-icon-button" uk-icon="twitter" rel="nofollow"
                       href="http://twitter.com/intent/tweet/?text={{ $article[0]->meta_description }};url={{ urldecode(urlencode(route('Article > Single', $article[0]->slug))) }}"
                       target="_blank"></a>

                    <a class="uk-icon-button" uk-icon="linkedin" rel="nofollow"
                       href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urldecode(urlencode(route('Article > Single', $article[0]->slug))) }};title={{ $article[0]->title }};source={{ route('Home') }}"
                       target="_blank"></a>

                    <a class="uk-icon-button" uk-icon="print"
                       onclick="printJS({ printable: 'print_article', type: 'html'})"></a>


                    <br>
                    <br>
                    <br>

                    <input class="uk-hidden" type="text" id="DirectUrl"
                           value="{{ route('Article > Direct', $article[0]->id) }}">
                    <a uk-tooltip="لینک کوتاه" onclick="CopyUrl()"
                       class="uk-text-meta uk-link-reset">{{ route('Article > Direct', $article[0]->id) }} <span
                            uk-icon="link"></span></a>
                    <script>
                                function CopyUrl() {
                                    var copyText = document.getElementById("DirectUrl");
                                    copyText.select();
                                    copyText.setSelectionRange(0, 99999)
                                    document.execCommand("copy");
                                    UIkit.notification({
                                        message: "<span uk-icon='icon: copy'></span> کپی شد.",
                                        pos: 'bottom-right',
                                        status: 'success'
                                    });
                                }
                    </script>
            </div>
        </metabox>
    @endif


    <!-- Advertise socket - section 003 -->
        <div class="uk-margin">
            @if(count($advertises) > 0)
                @foreach($advertises->where('socket', 'article-003')->all() as $advertise)
                    @if($advertise->just_admin && !Auth::check())
                        @break
                    @else
                        <div>
                            {!! $advertise->content !!}
                        </div>
                        <hr>
                    @endif
                @endforeach
            @endif
        </div>
        <!-- Advertise socket - section 003 -->

        <!-- Related News - start -->
        <div class="sidebar-element">
            <div class="uk-card uk-card-hover uk-card-body uk-margin-bottom">
                <h3 class="uk-card-title uk-text-meta">
                    <span class="socket-title-icon" uk-icon="quote-right"></span>
                    <span>اخبار مرتبط</span>
                </h3>
                <hr class="uk-divider-small">
                @if(isset($relateds) && count($relateds) > 0)
                    <div class="uk-child-width-1-3@m uk-grid-match uk-grid-small" uk-grid>
                        @foreach($relateds as $related)
                            <div class="">
                                @if($related->cover == 'ghost.png')
                                    <a class="uk-link-reset" href="{{ route('Article > Single', $related->slug) }}">
                                        <div class="uk-border-rounded"
                                             style='height: 152px; background-image: url("https://jahaneghtesad.com/assets/image/ghost.png"); background-position: center; background-size: cover; background-repeat: no-repeat'>
                                        </div>
                                        <p class="uk-margin-s,a;;-top">
                                            <span class="uk-text-medium"><span class="related-title-iterator">{{ $loop->iteration }}</span>&nbsp;{{ $related->title }}</span>
                                        </p>
                                    </a>
                                @else
                                    <a class="uk-link-reset" href="{{ route('Article > Single', $related->slug) }}">
                                        <div class="uk-border-rounded"
                                            style='height: 152px; background-image: url("{{ $related->cover }}"); background-position: center; background-size: cover; background-repeat: no-repeat'>
                                        </div>
                                        <p class="uk-margin-s,a;;-top">
                                            <span class="uk-text-medium"><span class="related-title-iterator">{{ $loop->iteration }}</span>&nbsp;{{ $related->title }}</span>
                                        </p>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="uk-alert uk-alert-warning">
                        متاسفانه مورد مرتبطی یافت نشد.
                    </div>
                @endif
            </div>
        </div>
        <!-- Related News - end -->

        <comments>
        @if( env('DISQUS_SYSTEM') )
        @include('public.article.disqus')
        @else
        @include('public.article.comments')
        @endif
        </comments>
    </article>
@endsection
