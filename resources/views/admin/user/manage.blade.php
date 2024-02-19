@extends('admin.template')

@section('meta')
<title>مدیریت کاربران</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                مدیریت کاربران
            </h2>
            <div class="uk-margin">
                <div>
                    <a href="" target="_blank" class="uk-button uk-button-small uk-border-rounded uk-button-primary">ایجاد کاربر</a>
                </div>
                <div class="uk-margin">
                  @if(isset($_GET['rule']) && $_GET['rule'] == 'admin')
                    <a href="{{ route('Users > Manage') }}"><span style="background: darkgray" class="uk-label"><span uk-icon="icon: close"></span>
                      مدیران
                    </span></a>
                  @endif
                  @if(isset($_GET['rule']) && $_GET['rule'] == 'member')
                    <a href="{{ route('Users > Manage') }}"><span style="background: darkgray" class="uk-label"><span uk-icon="icon: close"></span>
                      کاربران
                    </span></a>
                  @endif
                  @if(!isset($_GET['rule']))
                    <a href="?rule=admin" class="uk-button uk-button-text uk-text-meta">مدیران</a> |
                    <a href="?rule=member" class="uk-button uk-button-text uk-text-meta">کاربران</a>
                  @endif
                </div>
            </div>

            @if(count($users) > 0)
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-striped uk-table-hover">
                        <thead>
                        <tr>
                            <th>نام کاربری</th>
                            <th>ایمیل</th>
                            <th>سطح دسترسی</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                          <th>نام کاربری</th>
                          <th>ایمیل</th>
                          <th>سطح دسترسی</th>
                          <th>وضعیت</th>
                          <th>عملیات</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @include('admin.user.fetch')
                        </tbody>
                    </table>
                </div>
                {{ $users->appends(request()->query())->render("pagination::uikit-dark") }}

            @else
                <div class="uk-alert-warning" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>کاربری در سیستم موجود نیست.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
