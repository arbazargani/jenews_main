<div class="uk-padding">
    <ul class="uk-nav uk-nav-default tm-nav">
            <h5 class="uk-light"><a class="uk-link-reset" href="{{ route('Admin') }}"><span class="uk-icon-button" uk-icon="icon: home"></span> داشبورد</a></h5>
            <ul class="uk-nav-sub">
                <li class=""><a href="{{ route('Home') }}" target="_blank">نمایش وبسایت</a></li>
            </ul>
    </ul>
    <hr>
    @php $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id()) @endphp
    <ul class="uk-nav uk-nav-default tm-nav">
        <h5 class="uk-light"><span class="uk-icon-button" uk-icon="file-edit"></span> محتوا</h5>
        <ul class="uk-nav-sub">
            @if($user->canEditArticles())
            <li class=""><a href="{{ route('Article > Manage') }}">اخبار</a></li>
            @endif
            @if($user->canEditPages())
            <li class=""><a href="{{ route('Page > Manage') }}">صفحات</a></li>
            @endif
            @if($user->canEditCategories())
            <li class=""><a href="{{ route('Category > Manage') }}">دسته‌ها</a></li>
            @endif
            @if($user->canEditTags())
            <li class=""><a href="{{ route('Tag > Manage') }}">برچسب‌ها</a></li>
            @endif
            @if($user->canEditComments())
            <li class=""><a href="{{ route('Comment > Manage') }}">دیدگاه‌ها</a></li>
            @endif
        </ul>
    </ul>
    <hr>

    <ul class="uk-nav uk-nav-default tm-nav">
        <h5 class="uk-light"><span class="uk-icon-button" uk-icon="paint-bucket"></span> گالری تصاویر</h5>
        <ul class="uk-nav-sub">
        <li class=""><a href="{{ route('Gallery > New') }}">ایجاد</a></li>
        <li class=""><a href="{{ route('Gallery > Manage') }}">مدیریت</a></li>
        </ul>
    </ul>
    <hr>


    <ul class="uk-nav uk-nav-default tm-nav">
        <h5 class="uk-light"><span class="uk-icon-button"  uk-icon="users"></span> کاربران</h5>
        <ul class="uk-nav-sub">
            <li class=""><a href="{{ route('Profile') }}">پروفایل شما</a></li>
            @if($user->CanEditOtherUsers())
            <li class=""><a href="{{ route('Users > Manage') }}">سایر کاربران</a></li>
            @endif
        </ul>
    </ul>
    <hr>
    @if($user->canManageAds())
    <ul class="uk-nav uk-nav-default tm-nav">
        <h5 class="uk-light"><span class="uk-icon-button"  uk-icon="forward"></span> تبلیغات</h5>
        <ul class="uk-nav-sub">
            <li class=""><a href="{{ route('Advertise > Manage') }}">مدیریت</a></li>
            <li class=""><a href="{{ route('Advertise > New') }}">ایجاد</a></li>
        </ul>
    </ul>
    <hr>
    @endif

    @if($user->CanUseAnalyticsPanel())
    <ul class="uk-nav uk-nav-default tm-nav">
        <h5 class="uk-light"><span class="uk-icon-button"  uk-icon="gitter"></span> آمار سامانه</h5>
        <ul class="uk-nav-sub">
            <li class=""><a href="{{ route('Anayltics > Manage') }}">آمار روزانه</a></li>
        </ul>
    <hr>
    @endif

    @if($user->CanManageSettings())
    <ul class="uk-nav uk-nav-default tm-nav">
        <h5 class="uk-light"><span class="uk-icon-button"  uk-icon="settings"></span> تنظیمات</h5>
        <ul class="uk-nav-sub">
            <li class=""><a href="{{ route('Setting') }}">تنظیمات سیستم</a></li>
    </ul>
    <hr>
    @endif
    </ul>
</div>
