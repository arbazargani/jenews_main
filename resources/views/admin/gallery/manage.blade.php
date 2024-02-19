@extends('admin.template')

@section('meta')
<title>مدیریت گالری تصاویر</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                مدیریت گالری‌ها
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
                                    <th>آیدی</th>
                                    <!-- <th>محتوا</th> -->
                                    <th>پیش‌نمایش</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>آیدی</th>
                                    <!-- <th>محتوا</th> -->
                                    <th>پیش‌نمایش</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($galleries as $gallery)
                                    <tr>
                                        <td>{{ $gallery->title }}</td>
                                        <td>{{ $gallery->timestamp }}</td>
                                        <td>غیرفعال</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="uk-alert-warning" uk-alert>
                            <a class="uk-alert-close" style="color: black" uk-close></a>
                            <p>موردی در سیستم موجود نیست.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
