<div class="uk-background-secondary uk-light uk-padding uk-padding-remove-bottom uk-margin-medium-top">
    <!-- sockets holder -->
    <div class="uk-child-width-1-4@m uk-margin uk-background-secondary" uk-grid>

        <!-- socket -->
        <div class="uk-container">
            <img src="{{ asset($settings['logo_src']->value) }}" style="width: 70%; background: white; padding: 3px; margin: 10px 0px 10px 0px; border-radius: 3px; vertical-align: middle;" alt="{{ env('APP_NAME') }}">
        </div>
        <!-- socket -->


        <!-- socket -->
        <div class="uk-container">
            <h4 class="uk-text-emphasis">صفحات</h4>
            <hr class="uk-divider-small">
            <ul class="uk-list">
                <li>
                    <a class="uk-link-reset" href="{{ route('Home > Archive') }}">آرشیو اخبار</a>
                </li>
                <li>
                   <a class="uk-link-reset" href="{{ env('SITE_URL') }}/page/تماس-با-ما">تماس با ما</a>
                </li>
                <li>
                   <a class="uk-link-reset" href="{{ env('SITE_URL') }}/page/ارتباط-با-ما">ارتباط با ما</a>
                </li>
            </ul>
        </div>
        <!-- socket -->


        <!-- socket -->
        <div class="uk-container">
            <h4 class="uk-text-emphasis">آخرین اخبار</h4>
            <hr class="uk-divider-small">
            @php
                $latest = \App\Models\Article::latest()->where('state', 1)->where('created_at', '<=', \Carbon\Carbon::now())->limit(3)->get();
            @endphp
            <ul class="uk-list">
            @foreach($latest as $new)
                <li>
                    <span uk-icon="dash"></span> <a class="uk-link-reset" href="">{{ $new->title }}</a>
                </li>
            @endforeach
            </ul>
        </div>
        <!-- socket -->


        <!-- socket -->
        <div class="uk-container">
            <h4 class="uk-text-emphasis">جستجو</h4>
            <hr class="uk-divider-small">
            <form  class="uk-grid-small" action="/" uk-grid>
                <div class="uk-width-2-3">
                    <input class="uk-input" type="text" name="query" id="query">
                </div>
                <div class="uk-width-expand">
                    <button class="uk-button uk-button-primary" type="submit">جستجو</button>
                </div>
            </form>
        </div>
        <!-- socket -->

    </div>
    <!-- sockets holder -->

    <!-- sockets holder -->
    <div class="uk-background-secondary uk-padding-small" style="padding: 10px; border-top: 1px solid #4e4e4e;" uk-grid>

{{--        <div class="uk-width-1-2">--}}
{{--            <img src="{{ asset('assets/image/logo.png') }}" style="width: 24px; height: 24px; vertical-align: middle;" alt="Alireza Bazargani">--}}
{{--            <span style="font-size: 11px!important;">طراحی توسط</span>--}}
{{--            <a class="uk-link-reset uk-text-primary" href="{{ route('Home') }}" target="_blank" rel="follow">--}}
{{--                <span style="font-size: 11px!important;">علیرضا بازرگانی</span>--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="uk-width-1-2@m">
            <div class="uk-background-secondary uk-padding-small" style="padding: 10px;" uk-grid>
{{--                <div class="uk-width-1-2@m">--}}
{{--                    <img src="{{ asset('assets/image/mamooth-cms.png') }}" style="width: 24px; height: 24px; background: white; padding: 2px; border-radius: 3px; vertical-align: middle;" alt="MAMOOT CMS">--}}
{{--                    <a class="uk-link-reset uk-text-primary" href="{{ route('Home') }}" target="_blank" rel="follow">--}}
{{--                        <span style="font-size: 11px!important;">سیستم مدیریت محتوای 'ماموت'</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="uk-width-1-2@m">
                    <img src="/assets/image/primer-studio-mini.png" style="width: 24px; height: 24px; background: white; padding: 2px; border-radius: 3px; vertical-align: middle;" alt="Primer Studio">
                    <a class="uk-link-reset uk-text-primary" href="https://primerstudio.io" target="_blank" rel="follow">
                        <span style="font-size: 11px!important;">طراحی توسط استودیو پرایمر</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="uk-width-1-2@m">
            <a class="uk-float-left" href="{{ route('Rss') }}" target="_blank" class="uk-icon-link" uk-icon="rss"></a>
            <span class="uk-float-left"> &nbsp;&nbsp;|&nbsp;&nbsp;</span>
            <a href="https://www.instagram.com/smtnewspaper/?hl=en" target="_blank" class="uk-float-left" uk-icon="instagram"></a>
        </div>
    </div>
    <!-- sockets holder -->

</div>
