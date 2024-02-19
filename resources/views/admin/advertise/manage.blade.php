@extends('admin.template')

@section('meta')
<title>مدیریت جایگاه‌های تبلیغاتی</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                مدیریت جایگاه‌های تبلیغاتی
            </h2>
            <div class="uk-grid-small uk-position-relative uk-grid" uk-grid>
                <div class="uk-width-1-1">
                    @if($errors->any())
                    <div class="uk-alert uk-alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </div>
                    @endif
                    @if(count($advertises) > 0)
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped uk-table-hover">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>ناشر</th>
                                    <!-- <th>محتوا</th> -->
                                    <th>سوکت</th>
                                    <th>کلیک</th>
                                    <th>وضعیت</th>
                                    <th>نمایش عمومی</th>
                                    <th>انقضا</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>ناشر</th>
                                    <!-- <th>محتوا</th> -->
                                    <th>سوکت</th>
                                    <th>کلیک</th>
                                    <th>وضعیت</th>
                                    <th>نمایش عمومی</th>
                                    <th>انقضا</th>
                                    <th>عملیات</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($advertises as $advertise)
                                    <tr>
                                        <td>{{ $advertise->title }}</td>
                                        <td>{{ $advertise->author }}</td>
                                        <td>{{ $advertise->socket }}</td>
                                        <td>{{ $advertise->views }}</td>
                                        <td>@if($advertise->state) <span class="uk-text-success">فعال</span> @else <span class="uk-text-danger">غیرفعال</span> @endif</td>
                                        <td>@if($advertise->just_admin) <span class="uk-text-danger" uk-icon="close"></span> @else <span class="uk-text-success" uk-icon="check"></span> @endif</td>
                                            <td>@if($advertise->expires_at > date("Y-m-d H:i:s")) <span class="uk-text-success">{{ $advertise->expires_at }}</span> @else <span class="uk-text-danger">منقضی شده</span> @endif</td>
                                        <td>
                                          <a class="uk-button uk-button-primary" href="{{ route('Advertise > Edit', $advertise->id) }}" type="submit">ویرایش</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="uk-alert-warning" uk-alert>
                            <a class="uk-alert-close" style="color: black" uk-close></a>
                            <p>تبلیغی در سیستم موجود نیست.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
