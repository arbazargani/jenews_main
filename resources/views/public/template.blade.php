@php
$request_name = Route::currentRouteName();
$request_segment_one = Request::segment(1);
$is_amp = (strpos($request_name, '> AMP') !== false && $request_segment_one == 'amp') ? true : false;
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="generator" content="Mamooth CMS" />
		<meta name="Development" content="Primer Studio" />
		<meta name="author" content="JahanEghtesad" />
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/image/fav.png') }}">
    @yield('meta')
		<link rel="stylesheet" href="{{ asset('assets/3.7.2/css/uikit-rtl.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/fonts/vazirmatn/Vazirmatn-font-face.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}" />
        @if($request_name != 'Old Search' && isset($article) && !is_null($article[0]) && !is_null($article[0]->meta_canonical))
        <link rel="canonical" href="{{ $article[0]->meta_canonical }}" />
        @else
        <link rel="canonical" href="{{ urldecode(url()->current()) }}" />
        @endif
		<script src="{{ asset('assets/3.7.2/js/uikit.min.js') }}"></script>
		<script src="{{ asset('assets/3.7.2/js/uikit-icons.min.js') }}"></script>

{{--        <link href="{{ asset('assets/css/plyr.css') }}" rel="stylesheet">--}}
{{--        <script src="{{ asset('assets/js/plyr.polyfilled.js') }}"></script>--}}
{{--        <script src="{{ asset('assets/js/clappr.min.js') }}"></script>--}}

        <style media="screen">
            h1 {
                font-size: 1.3rem!important;
                font-weight: bolder;
            }
            h2 {
                font-size: 1.1rem!important;
                font-weight: bolder;
            }
            h3 {
                font-size: 16px!important;
                font-weight: bolder;
            }
            h4 {
                font-size: 16px!important;
                font-weight: bolder;
            }

            @media (min-width: 1200px) {
                .sidebar-element .uk-card-body {
                    padding: 40px 14px;
                }
            }
            @media screen and (max-width: 479px) {
                /* start of phone styles */
                h1 {
                    font-weight: bolder;
                    font-size: 24px!important;
                }
                h2 {
                    font-weight: bolder;
                    font-size: 20px!important;
                }
                h3 {
                    font-weight: bolder;
                    font-size: 16px!important;
                }
                h4 {
                    font-weight: bolder;
                    font-size: 16px!important;
                }
            }

            .pulse {
                /*margin:100px;*/
                margin-left: 8px;
                vertical-align: middle;
                display: inline-block;
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: #01954170;
                cursor: pointer;
                box-shadow: #019541;
                animation: pulse 2s infinite;
            }
            .dead-pulse {
                /*margin:100px;*/
                margin-left: 8px;
                vertical-align: middle;
                display: inline-block;
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: #f2f2f2;
                cursor: pointer;
                box-shadow: #ababab;
                /* animation: pulse 2s infinite; */
            }
            .pulse:hover {
                animation: none;
            }

            @-webkit-keyframes pulse {
                0% {
                    -webkit-box-shadow: 0 0 0 0 rgb(1, 149, 65);
                }
                70% {
                    -webkit-box-shadow: 0 0 0 10px rgba(204,169,44, 0);
                }
                100% {
                    -webkit-box-shadow: 0 0 0 0 rgba(204,169,44, 0);
                }
            }
            @keyframes pulse {
                0% {
                    -moz-box-shadow: 0 0 0 0 rgb(1, 149, 65);
                    box-shadow: 0 0 0 0 rgb(1, 149, 65);
                }
                70% {
                    -moz-box-shadow: 0 0 0 10px rgba(204,169,44, 0);
                    box-shadow: 0 0 0 10px rgba(204,169,44, 0);
                }
                100% {
                    -moz-box-shadow: 0 0 0 0 rgba(204,169,44, 0);
                    box-shadow: 0 0 0 0 rgba(204,169,44, 0);
                }
            }

            .select2-container {
                max-width: 100% !important;
            }
            </style>
        {!! $settings['before_body_codes']->value !!}
</head>
<body class="uk-background-muted" id="top">
    <div class="uk-section-primary theme-background-green uk-preserve-color">
        <div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent uk-light; top: 200">
            @include('public.template-parts.header')
        </div>
    </div>
    @include('public.template-parts.date-bar')

    <div style="padding: 1% 5% 1% 5%;" uk-grid>
        <!-- main -->
        <div class="uk-width-expand@m">
            @yield('content')
        </div>
        <!-- main -->

        <!-- sidebar right -->
{{--			<div class="uk-width-expand@m">--}}
        <div class="uk-width-1-4@m">
         @include('public.template-parts.sidebar')
        </div>
        <!-- sideba right -->

        <!-- sidebar left -->
{{--            <div class="uk-width-expand@m">--}}
        <div class="uk-width-1-4@m">
            @include('public.template-parts.sidebar-left')
        </div>
        <!-- sideba left -->
    </div>

    <div class="uk-position-small uk-padding-remove uk-position-fixed uk-position-bottom-right" id="top-btn-wrapper">
        <a href="#top" id="top-btn" uk-totop uk-scroll></a>
    </div>
    <script>
        //Get the button:
        mybutton = document.getElementById("top-btn-wrapper");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
    <!-- Advertise socket - position fixed -->
    @if(count($advertises) > 0)
            @foreach($advertises->where('socket', 'position_fixed_mobile')->all() as $advertise)
                    @if($advertise->just_admin && !Auth::check())
                            @break
                    @else
                            <div @if($advertise->mobile_only) class="uk-hidden@s" @endif style="z-index: 111; position: fixed; bottom: 0; width: 100%;">{!! $advertise->content !!}</div>
                    @endif
            @endforeach
    @endif
    <!-- Advertise socket - position fixed -->
    @include('public.template-parts.footer')
    @include('public.template-parts.scripts')
    {!! $settings['end_body_codes']->value !!}
</body>
</html>
