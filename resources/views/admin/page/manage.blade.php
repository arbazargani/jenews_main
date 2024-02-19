@extends('admin.template')

@section('meta')
<title>مدیریت برگه‌ها</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                مدیریت برگه‌ها
            </h2>
            <div class="uk-margin">
                <div>
                    <a href="{{ route('Page > New') }}" target="_blank" class="uk-button uk-button-small uk-border-rounded uk-button-primary">ایجاد برگه</a>
                </div>
                <div class="uk-margin">
                  @if(isset($_GET['state']) && $_GET['state'] == 'all')
                    <a href="{{ route('Page > Manage') }}"><span style="background: darkgray" class="uk-label"><span uk-icon="icon: close"></span>
                      همه
                    </span></a>

                  @elseif(isset($_GET['state']) && $_GET['state'] == '0')
                  <a href="{{ route('Page > Manage') }}"><span style="background: darkgray" class="uk-label"><span uk-icon="icon: close"></span>
                    پیش‌نویس
                  </span></a>
                  @elseif(isset($_GET['state']) && $_GET['state'] == '-1')
                  <a href="{{ route('Page > Manage') }}"><span style="background: darkgray" class="uk-label"><span uk-icon="icon: close"></span>
                    زباله‌دان
                  </span></a>
                  @endif
                  @if(!isset($_GET['state']))
                    <a href="?state=all" class="uk-button uk-button-text uk-text-meta">نمایش همه</a> |
                    <a href="?state=0" class="uk-button uk-button-text uk-text-meta">پیش‌نویس</a> |
                    <a href="?state=-1" class="uk-button uk-button-text uk-text-meta">زباله‌دان</a>
                  @endif
                </div>
            </div>
            @if(count($pages))
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-striped uk-table-hover">
                        <thead>
                        <tr>
                            <th>عنوان برگه</th>
                            <th>تاریخ انتشار</th>
                            <td>وضعیت</td>
                            <th>ویرایش</th>
                            <th>عملیات</th>
                            <th>حذف</th>
                            <th>بازدید</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td>عنوان برگه</td>
                            <td>تاریخ انتشار</td>
                            <td>وضعیت</td>
                            <th>ویرایش</th>
                            <th>عملیات</th>
                            <th>حذف</th>
                            <th>بازدید</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->title }}</td>
                                @php
                                    $jalaliDate = new Verta($page->created_at);
                                    $jalaliDate->timezone('Asia/Tehran');
                                    $jalaliDate = Verta::instance($page->created_at);
                                    $jalaliDate = Facades\Verta::instance($page->created_at);
                                @endphp
                                <td>{{ $jalaliDate }}</td>
                                <td>
                                    @if($page->state == 0)
                                        <div class="state-drafted"></div>
                                    @elseif($page->state == 1)
                                        <div class="state-published"></div>
                                    @else
                                        <div class="state-deleted"></div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('Page > Edit', $page->id) }}">
                                        <button class="uk-button uk-button-small uk-button-secondary">ویرایش</button>
                                    </a>
                                </td>
                                <td>
                                    @if($page->state == -1)
                                        <form action="{{ route('Page > Restore', $page->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="uk-button uk-button-small uk-button-primary">بازیابی</button>
                                        </form>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($page->state == -1)
                                    <form action="{{ route('Page > Delete Permanently', $page->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="uk-button uk-button-text uk-text-danger">حذف همیشگی</button>
                                    @else
                                    <form action="{{ route('Page > Delete', $page->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="uk-button uk-button-text uk-text-danger">حذف</button>
                                    @endif

                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('Page > Single', $page->slug) }}">بازدید</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pages->appends(request()->query())->render("pagination::uikit-dark") }}
            @else
                <div class="uk-alert-warning" uk-alert>
                    <a class="uk-alert-close" style="color: black" uk-close></a>
                    <p>برگه‌ای در سیستم موجود نیست.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
