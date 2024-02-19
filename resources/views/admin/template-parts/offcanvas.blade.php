<div id="offcanvas-nav" uk-offcanvas="overlay: true; mode: reval">
    <div class="uk-offcanvas-bar" style="width: 250px">

        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <ul class="uk-nav uk-nav-default tm-nav">
                <h5><a class="uk-link-reset" href="{{ route('Admin') }}"><span class="uk-icon-button" uk-icon="icon: home"></span> داشبورد</a></h5>
                <ul class="uk-nav-sub uk-margin-right">
                    <!-- // -->
                </ul>
        </ul>

        <ul class="uk-nav uk-nav-default tm-nav">
                <h5><span class="uk-icon-button" uk-icon="file-edit"></span> محتوا</h5>
                <ul class="uk-nav-sub uk-margin-right">
                    <li class=""><a href="{{ route('Article > Manage') }}">مقالات</a></li>
                    <li class=""><a href="{{ route('Page > Manage') }}">صفحات</a></li>
                    <li class=""><a href="{{ route('Category > Manage') }}">دسته‌ها</a></li>
                    <li class=""><a href="{{ route('Tag > Manage') }}">برچسب‌ها</a></li>
                    <li class=""><a href="{{ route('Comment > Manage') }}">دیدگاه‌ها</a></li>
                </ul>
            <li>
        </ul>
        <hr>

        <ul class="uk-nav uk-nav-default tm-nav">
            <h5><span class="uk-icon-button"  uk-icon="users"></span> کاربران</h5>
            <ul class="uk-nav-sub uk-margin-right">
                <li class=""><a href="{{ route('Profile') }}">پروفایل شما</a></li>
                <li class=""><a href="{{ route('Users > Manage') }}">سایر کاربران</a></li>
            </ul>
        </ul>
        <hr>

        <ul class="uk-nav uk-nav-default tm-nav">
            <h5><span class="uk-icon-button"  uk-icon="settings"></span> تنظیمات</h5>
            <ul class="uk-nav-sub uk-margin-right">
                <li class=""><a href="{{ route('Setting') }}">تنظیمات سیستم</a></li>
            </ul>
        </ul>

    </div>
</div>
