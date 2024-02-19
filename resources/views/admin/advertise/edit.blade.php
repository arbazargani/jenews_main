@extends('admin.template')

@section('meta')
    <title>ویرایش تبلیغ</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 class="uk-h2 tm-heading-fragment">
                ویرایش تبلیغ
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('Advertise > Update', $advertise->id) }}" method="post" class="uk-grid-small"
                  uk-grid>
                @csrf
                <div class="uk-width-1-3@m">
                    <label class="uk-form-label">عنوان</label>
                    <input class="uk-input" type="text" name="title" value="{{ $advertise->title }}" required>
                </div>
                <div class="uk-width-1-3@m">
                    <label class="uk-form-label">ناشر</label>
                    <input class="uk-input" type="text" name="author" value="{{ $advertise->author }}" required>
                </div>
                <div class="uk-width-1-3@m">
                    <label class="uk-form-label">انقضا</label>
                    <input class="uk-input datepicker" type="text" name="expires_at" value="{{ $advertise->expires_at }}" required>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">جایگاه</label>
                    <br>
                    <select class="uk-select" name="socket" style="width: 200px;" required>
                        @foreach($sockets as $socket)
                            <option
                                value="{{ $socket }}" @if($socket == $advertise->socket){!! 'selected' !!}@endif>{{ $socket }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">نوع</label>
                    <br>
                    <select class="uk-select" name="type" style="width: 200px;" required>
                        @foreach($types as $type)
                            <option value="{{ $type }}"
                                    @if($type == $advertise->type) selected="selected" @endif>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">وضعیت</label>
                    <br>
                    <select class="uk-select" name="state" style="width: 200px;" required>
                        <option value="1" @if($advertise->state) selected="selected" @endif>فعال</option>
                        <option value="0" @if(!$advertise->state) selected="selected" @endif>غیرفعال</option>
                    </select>
                </div>
                <div class="uk-width-1-4@m uk-margin">
                    <label class="uk-form-label">نمایش</label>
                    <br>
                    <select class="uk-select" name="just_admin" style="width: 200px;" required>
                        <option value="0" @if(!$advertise->just_admin) selected="selected" @endif>عمومی</option>
                        <option value="1" @if($advertise->just_admin) selected="selected" @endif>تست</option>
                    </select>
                </div>
                <div class="uk-width-1-2@m uk-margin">
                    <label class="uk-form-label">محتوا</label>
                    <br>
                    <br>
                    <textarea style="direction: ltr !important; font-family: monospace !important; font-size: 12px;"
                              class="uk-textarea" rows="16" name="content">{{ $advertise->content }}</textarea>
                    <br>
                    <br>
                    <label class="uk-form-label">لینک</label>
                    <br>
                    <br>
                    <input style="direction: ltr !important; font-family: monospace !important; font-size: 12px;" class="uk-input" type="text" name="link" value="{{ $advertise->link }}">
                    <br>
                    <br>
                    <button type="submit" class="uk-button uk-button-primary" name="button">ذخیره</button>
                </div>
                <div class="uk-width-1-2@m uk-margin">
                    <input class="uk-checkbox" type="checkbox" name="mobile_only" id="mobile_only" value="1" @if($advertise->mobile_only) checked @endif>
                    <label class="uk-form-label" for="mobile_only">فقط موبایل</label>
                    <br>
                    <br>
                    <label class="uk-form-label">پیش‌نمایش</label>
                    <br>
                    <br>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body">
                            {!! $advertise->content !!}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
