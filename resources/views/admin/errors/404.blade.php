@extends('admin.template')

@section('meta')
    <title>عدم اعتبار</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-default">
        <div class="uk-container uk-container-small uk-position-relative">
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close"></a>
                <p>شما مجاز به انجام این عملیات نمی‌باشید.</p>
                @if(isset($back))
                    <a href="{{ $back }}">بازگشت</a>
                @endif
            </div>
        </div>
    </div>
@endsection

