@extends('admin.template')

@section('meta')
    <title>افزودن تبلیغ</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 class="uk-h2 tm-heading-fragment">
                افزودن تبلیغ
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('Advertise > Submit') }}" method="post" class="uk-grid-small"
                  uk-grid>
                @csrf
                <div class="uk-width-1-3@m">
                    <label class="uk-form-label">عنوان</label>
                    <input class="uk-input" type="text" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="uk-width-1-3@m">
                    <label class="uk-form-label">ناشر</label>
                    <input class="uk-input" type="text" name="author" value="{{ old('author') }}" required>
                </div>
                <div class="uk-width-1-3@m">
                    <label class="uk-form-label">انقضا</label>
                    <input class="uk-input datepicker" type="text" name="expires_at" value="{{ old('expires_at') }}" required>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">جایگاه</label>
                    <br>
                    <select class="uk-select" name="socket" style="width: 200px;" required>
                        @foreach($sockets as $socket)
{{--                            <option value="{{ $socket }}" @if(array_search($socket, $used_sockets) !== FALSE){!! 'disabled' !!}@endif>{{ $socket }}</option>--}}
                            <option value="{{ $socket }}">{{ $socket }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">نوع</label>
                    <br>
                    <select class="uk-select" name="type" style="width: 200px;" required>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">وضعیت</label>
                    <br>
                    <select class="uk-select" name="state" style="width: 200px;" required>
                        <option value="1">فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">نمایش</label>
                    <br>
                    <select class="uk-select" name="just_admin" style="width: 200px;" required>
                        <option value="0">عمومی</option>
                        <option value="1">تست</option>
                    </select>
                </div>
                <div class="uk-width-1-2@m uk-margin">
                    <label class="uk-form-label">محتوا</label>
                    <br>
                    <br>
                    <textarea style="direction: ltr !important; font-family: monospace !important; font-size: 12px;"
                              class="uk-textarea" rows="16" name="content">{{ old('content') }}</textarea>
                </div>
                <div class="uk-width-1-2@m uk-margin">
                    <label class="uk-form-label">لینک</label>
                    <br>
                    <br>
                    <input style="direction: ltr !important; font-family: monospace !important; font-size: 12px;" class="uk-input" type="text" name="link" value="{{ old('link') }}">
                    <br>
                    <br>
                    <input class="uk-checkbox" type="checkbox" name="mobile_only" id="mobile_only" value="1">
                    <label class="uk-form-label" for="mobile_only">فقط موبایل</label>
                    <br>
                    <br>
                    <button type="submit" class="uk-button uk-button-primary" name="button">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection
