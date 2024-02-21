<nav class="uk-navbar-container uk-margin uk-margin-remove-bottom uk-box-shadow-small" id="navbar" uk-navbar>
{{--    <a class="uk-navbar-item uk-logo" href="#">{{ $settings['website_name']->value }}</a>--}}
    <a class="uk-navbar-item uk-logo uk-visible@m" href="{{ route('Home') }}">
        <!-- <img src="{{ asset('assets/image/mamooth-cms.png') }}" style="width: 70%; background: white; padding: 3px; margin: 10px 0px 10px 0px; border-radius: 3px; vertical-align: middle;" alt="MAMOOT CMS"> -->
        <img src="{{ asset($settings['logo_src']->value) }}" style="width: 70%; background: white; padding: 3px; margin: 10px 0px 10px 0px; border-radius: 3px; vertical-align: middle;" alt="{{ env('APP_NAME') }}">
    </a>
    <a class="uk-navbar-item uk-logo uk-hidden@m" href="{{ route('Home') }}">
        <!-- <img src="{{ asset('assets/image/mamooth-cms.png') }}" style="width: 70%; margin: 3px 0px 3px 0px; vertical-align: middle;" alt="MAMOOT CMS"> -->
        <img src="{{ asset($settings['logo_src']->value) }}" style="width: 70%; background: #ffffff; padding: 3px; margin: 3px 0px 3px 0px; border-radius: 3px; vertical-align: middle;" alt="{{ env('APP_NAME') }}">
    </a>
    <div class="uk-navbar-right uk-margin-small-right uk-visible@m">
        <ul class="uk-navbar-nav">
            @php
                $menu = new App\Http\Controllers\HomeController();
                $menu_structure = $menu->MenuStructureWithParents();
                $single_categories = $menu->MenuStructureWithoutParents();
            @endphp
            @foreach($menu_structure as $menu_parent => $menu_child)
                @if($menu_parent !== -1)
                    @php
                        $cat = \App\Models\Category::find((int) $menu_parent);
                    @endphp
                    <li>
                        @if($cat->slug == 'آرشیو-روزنامه')
                        <a style="color: white" href="{{ route('Archive > Newspaper') }}">آرشیو روزنامه</a>
                        @else
                        <a style="color: white" href="{{ route('Category > Archive', $cat->slug) }}">{{ $cat->name }}</a>
                        @endif
                        <div class="uk-navbar-dropdown uk-navbar-dropdown">
                            <div class="uk-navbar-dropdown-grid" uk-grid>
                                <div>
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        @foreach($menu_structure[$menu_parent] as $child)
                                        @if($child->show_in_menu)
                                            <li class="uk-margin-right"><a class="child" href="{{ route('Category > Archive', $child->slug) }}">{{ $child->name }}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    @foreach($menu_structure[$menu_parent] as $child)
                    @if($child->show_in_menu)
                        <li ><a style="color: white" href="{{ route('Category > Archive', $child->slug) }}">{{ $child->name }}</a></li>
                    @endif
                    @endforeach
                @endif
            @endforeach
            @foreach($single_categories as $category)
            @if($category->show_in_menu)
                <li><a style="color: white" href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a></li>
            @endif
            @endforeach
        </ul>
    </div>
    <div class="uk-navbar-left uk-margin-small-left">
        <ul class="uk-navbar-nav">
            <li class="uk-active uk-hidden@m"><a href="" uk-icon="menu" uk-toggle="target: #responsive-menu"></a></li>
            @if(Auth::check())
            <div class="uk-navbar-item uk-visible@m">
                <a class="uk-button uk-button-primary" href="{{ route('Admin') }}" >پنل مدیریت</a>
            </div>
            <div class="uk-navbar-item uk-visible@m">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="uk-button uk-button-text uk-text-muted" type="submit">خروج</button>
            </form>
            </div>
            @endif
        </ul>
    </div>
</nav>
<!-- Responsive off-canvas menu -->
<div id="responsive-menu" uk-offcanvas="overlay: true; mode: push">
    <div class="uk-offcanvas-bar mobile-nav">
        <button class="uk-offcanvas-close" type="button" uk-close></button>
        <br>
        <ul class="uk-nav uk-nav-default">
            <li class="uk-active uk-navbar-header uk-margin-bottom"><a href="{{ route('Home') }}"><span class="uk-icon-button" uk-icon="home"></span> خانه</a></li>
            <li class="uk-active uk-navbar-header"><a href="{{ route('Blog') }}"><span class="uk-icon-button" uk-icon="file-text"></span> سرویس‌ها</a></li>
            <li class="uk-parent uk-margin-bottom">
                <ul class="uk-nav-sub">
                @foreach($categories as $category)
                @if($category->id != 1)
                    <li class="uk-margin-right"><a href="{{ route('Category > Archive', $category->slug) }}">{{ $category->name }}</a></li>
                @endif
                @endforeach
                </ul>
            </li>
            <li class="uk-active uk-navbar-header uk-margin-bottom"><a href=""><span class="uk-icon-button" uk-icon="receiver"></span> ارتباط</a></li>
            <li class="uk-parent uk-margin-bottom">
                <ul class="uk-nav-sub">
                    <li class="uk-margin-right"><a href="/page/تماس-با-ما">تماس با ما</a></li>
                    <li class="uk-margin-right"><a href="/page/درباره-ما">درباره ما</a></li>
                    <li class="uk-margin-right"><a href="{{ route('Sitemap') }}">نقشه سایت</a></li>
                </ul>
            </li>
            @if(Auth::check())
            <li class="uk-active uk-navbar-header"><a href="{{ route('Admin') }}"><span class="uk-icon-button" uk-icon="user"></span> پنل مدیریت</a></li>
            <li class="uk-parent uk-margin-bottom">
                <ul class="uk-nav-sub">
                    <li class="uk-margin-right">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="uk-button uk-button-text uk-text-muted" type="submit">خروج</button>
                        </form>
                    </li>
                </ul>
            </li>
            @endif
            <hr>
            <div class="uk-container">
                <p>
                    <a href="https://www.instagram.com/jahan.eghtesad" target="_blank" class="uk-icon-button" uk-icon="instagram"></a>
                </p>
            </div>
        </ul>

    </div>
</div>
