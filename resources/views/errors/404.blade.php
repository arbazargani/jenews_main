@extends('public.template')

@section('title')
    <title>{{ 'یافت نشد' . " " . $settings['title_delimiter']->value . " " . $settings['website_name']->value }}</title>
@endsection

@section('content')
<div class="uk-padding-small" uk-grid>
    <div class="uk-article uk-width-1-1@m">
        <div class="uk-card uk-card-default uk-card-body">
            <p class="uk-text-center uk-text-lead">خطای ۴۰۴</p>
            <div class="uk-alert-warning" uk-alert>
                <p><span uk-icon="warning"></span> صفحه‌ای که به دنبال آن هستید را پیدا نمی‌کنیم.</p>
            </div>
            <p class="uk-text-meta">پیشنهاد می‌کنیم از بخش‌های زیر استفاده نمایید.</p>
            <ul class="uk-list uk-list-divider">
                <!-- <li><p class="uk-text"><span uk-icon="icon: search; ratio: 0.7"></span> <a href="" class="uk-link-reset">جستجوی اخبار</a></p></li> -->
                <li><p class="uk-text"><span uk-icon="icon: menu; ratio: 0.7"></span> <a href="{{ route('Home > Archive') }}" class="uk-link-reset">آرشیو تمامی اخبار</a></p></li>
                <li><p class="uk-text"><span uk-icon="icon: future; ratio: 0.7"></span> <a href="{{ route('Old Search') }}" class="uk-link-reset">دسترسی به اخبار قدیمی</a></p></li>
                <li><p class="uk-text"><span uk-icon="icon: clock; ratio: 0.7"></span> <a href="{{ route('Home') }}" class="uk-link-reset">آخرین اخبار امروز</a></p></li>
            </ul>
        </div>
    </div>
</div>

@endsection