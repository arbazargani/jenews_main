@extends('public.template')

@section('meta')
    <title>ورود {{ "{$settings['title_delimiter']->value} {$settings['website_name']->value}" }}</title>
    <meta name="description" content="ورود به سیستم">
    <meta name="robots" content="noindex, follow">
@endsection

@section('content')
<div class="uk-container uk-align-center uk-width-1-2@m uk-padding-remove uk-first-column" style="max-width: 1120px;">
    <div class="uk-card uk-card-default uk-box-shadow-small">
        <div class="uk-card-header" style="padding: 15px 30px 17px;">
            <h1 class="uk-margin-remove uk-text-lead uk-text-center">ورود به سامانه</h1>
        </div>
        <div class="uk-card-body uk-padding-xsmall">
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid="" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="uk-inline uk-width-1-1 uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: user" style="right: auto"></i>
                    <input id="email" type="text" placeholder="نام کاربری" class="uk-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="padding-left: 40px;" autofocus>
                </div>
                <div class="uk-inline uk-width-1-1 uk-grid-margin uk-first-column">
                    <i class="uk-form-icon uk-icon" uk-icon="icon: lock" style="right: auto"></i>
                    <input id="password" type="password" placeholder="گذرواژه" class="uk-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                </div>
                <div class="uk-inline uk-width-1-1 uk-grid-margin uk-first-column">
                    <input class="uk-checkbox form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        ذخیره سازی اطلاعات ورود
                    </label>
                </div>
                <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                    <button class="uk-button uk-button-primary uk-width-1-1" style="padding: 0px 8px;">ورود به سامانه</button>
                </div>

                <div class="uk-width-1-1 uk-text-center uk-first-column">
                    @if (Route::has('password.request'))
                        <a class="uk-link uk-link-reset uk-text-meta" href="{{ route('password.request') }}">
                            رمز عبور خود را فراموش کرده‌اید؟
                        </a>
                    @endif
                </div>

            </form>
        </div>
        <div class="uk-card-footer uk-text-center">
                <a class="uk-text-meta uk-link-reset" style="padding: 0px 8px;" href="{{ route('register') }}">ثبت نام</a>
        </div>
    </div>
</div>
@endsection
