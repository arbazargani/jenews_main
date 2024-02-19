@extends('admin.template')

@section('meta')
    <title>تنظیمات سیستم</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                تنظیمات سیستم
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative" action="{{ route('Setting > Update') }}" method="POST">
                @csrf
                <div uk-grid>
                    @foreach($settings as $setting)
                    <div class="uk-width-1-2@m uk-margin-small-bottom">
                        <div class="uk-inline uk-width-1-2    @if($loop->first) uk-first-column @endif">
                            <label for="name">{{ $setting->title }}</label>
                            @if($setting->type == 'text' || $setting->type == 'email')
                                <input type="{{ $setting->type }}" name="{{ $setting->name }}" id="{{ $setting->name }}" placeholder="{{ $setting->title }}" class="uk-input form-control" value="{{ $setting->value }}" {{ $setting->required ? 'required' : '' }}>
                            @elseif($setting->type == 'textarea')
                                <textarea name="{{ $setting->name }}" id="{{ $setting->name }}" placeholder="{{ $setting->title }}" rows="15" class="uk-textarea">{{ $setting->value }}</textarea>
                            @else
                                <span>نوع تعریف نشده است.</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
{{--                    <div class="uk-width-1-1 uk-margin-small-bottom uk-float-left">--}}
{{--                        @include('admin.setting.insert')--}}
{{--                    </div>--}}
                    <div class="uk-width-1-1 uk-margin-small-bottom uk-float-left">
                        <div class="uk-inline">
                            <button class="uk-button uk-button-primary" type="submit">بروزرسانی</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
