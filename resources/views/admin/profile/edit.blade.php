@extends('admin.template')

@section('meta')
<title>ویرایش پروفایل</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                پروفایل کاربری
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid="" action="{{ route('Profile > Update') }}" method="POST">
                @csrf
                <div class="uk-width-2-3@m">
                    <div class="uk-inline uk-width-1-1 uk-first-column">
                        <label for="name">نام</label>
                        <input type="text" name="name" id="name" placeholder="نام" class="uk-input form-control @error('name') is-invalid @enderror" value="{{ $user[0]->name }}" required style="padding-left: 40px;" autofocus>
                    </div>
                    <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-top">
                        <label for="family">نام خانوادگی</label>
                        <input type="text" family="family" id="family" placeholder="نام" class="uk-input form-control @error('family') is-invalid @enderror" value="{{ $user[0]->family }}" style="padding-left: 40px;" autofocus>
                    </div>
                    <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-top">
                        <label for="family" class="disabled">نام کاربری</label>
                        <p class="uk-input form-control" style="cursor: not-allowed">{{ $user[0]->username }}</p>
                    </div>
                    <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-top">
                        <label for="family" class="disabled">ایمیل</label>
                        <p class="uk-input form-control" style="cursor: not-allowed">{{ $user[0]->email }}</p>
                    </div>
                </div>
                <div class="uk-width-1-3@m">
                    <dl class="uk-description-list uk-description-list-divider">
                        <dt style="color: white;">در نظر داشته باشید:</dt>
                        <hr>
                        <dd class="uk-text-warning">نام کاربری قابل تغییر نیست.</dd>
                        <dd class="uk-text-warning">ایمیل قابل تغییر نیست.</dd>
                    </dl>
                    <hr class="uk-divider-icon">
                    <button type="submit" class="uk-button uk-button-primary uk-border-rounded">بروزرسانی</button>
                </div>
            </form>
        </div>
    </div>
@endsection
