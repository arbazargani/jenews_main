@extends('public.template')

@section('meta')
    <title>ثبت نام {{ "{$settings['title_delimiter']->value} {$settings['website_name']->value}" }}</title>
    <meta name="description" content="ثبت نام در سیستم">
    <meta name="robots" content="noindex, follow">
@endsection

@section('content')
<div class="uk-container uk-align-center uk-width-1-2@m uk-padding-remove uk-first-column" style="max-width: 1120px;">
    <div class="uk-card uk-card-default uk-box-shadow-small">
        <div class="uk-card-header" style="padding: 15px 30px 17px;">
            <h1 class="uk-margin-remove uk-text-lead uk-text-center">ثبت‌نام در سامانه</h1>
        </div>
        <div class="uk-card-body uk-padding-xsmall">
            @if($errors->any())
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <ul></ul>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid="" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: file-text" style="right: auto"></i>
                    <input id="name" type="text" placeholder="نام" class="uk-input form-control @error('name') uk-form-danger @enderror" name="name" value="{{ old('name') }}" autocomplete="name" style="padding-left: 40px;" autofocus>
                </div>
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: file-text" style="right: auto"></i>
                    <input id="family" type="text" placeholder="نام خانوادگی" class="uk-input form-control @error('family') uk-form-danger @enderror" name="family" value="{{ old('family') }}" autocomplete="family" style="padding-left: 40px;">
                </div>
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: user" style="right: auto"></i>
                    <input id="username" type="text" placeholder="نام کاربری" class="uk-input form-control @error('username') uk-form-danger @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" style="padding-left: 40px;">
                </div>
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: comment" style="right: auto"></i>
                    <input id="email" type="email" placeholder="ایمیل" class="uk-input form-control @error('email') uk-form-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="padding-left: 40px;">
                </div>
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: lock" style="right: auto"></i>
                    <input id="password" type="password" placeholder="رمز عبور" class="uk-input form-control @error('password') uk-form-danger @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" style="padding-left: 40px;">
                </div>
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: lock" style="right: auto"></i>
                    <input id="password_confirmation" type="password" placeholder="تکرار رمز عبور" class="uk-input form-control @error('password_confirmation') uk-form-danger @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required style="padding-left: 40px;">
                </div>
                <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                    {{--{{ __('Register') }}--}}
                    <button class="uk-button uk-button-primary uk-width-1-1" style="padding: 0px 8px;" name="LoginFromWeb">ثبت‌نام</button>
                </div>
            </form>
        </div>
        <div class="uk-card-footer uk-text-center">
            <a class="uk-text-meta uk-link-reset" style="padding: 0px 8px;" href="{{ route('login') }}">ورود</a>
        </div>
    </div>
</div>
@endsection
