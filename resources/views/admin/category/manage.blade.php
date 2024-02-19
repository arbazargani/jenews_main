@extends('admin.template')

@section('meta')
<title>ایجاد دسته جدید</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary uk-light">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                ایجاد دسته‌بندی
            </h2>
            <div class="uk-grid-small uk-position-relative uk-grid" uk-grid>
                <div class="uk-width-1-3@m uk-width-1-1@s">
                    @if($errors->any())
                        <div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form class="uk-grid-small uk-position-relative uk-grid" uk-grid="" action="{{ route('Category > Submit') }}" method="POST">
                        @csrf
                        <div class="uk-inline uk-width-1-1 uk-first-column">
                            <input type="text" name="name" id="name" placeholder="عنوان" class="uk-input form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required style="padding-left: 40px;">
                        </div>
                        <div class="uk-inline uk-width-1-1 uk-first-column">
                            <input type="text" name="slug" id="slug" placeholder="نامک" class="uk-input form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" style="padding-left: 40px;">
                        </div>
                        <div class="uk-inline uk-width-1-1 uk-first-column">
                            <select class="uk-select" name="parent" id="parent">
                                <option></option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="uk-inline uk-width-1-1 uk-first-column">
                            <button type="submit" class="uk-button uk-button-primary uk-border-rounded">انتشار</button>
                        </div>
                    </form>
                </div>
                <div class="uk-width-2-3@m uk-width-1-1@s uk-overflow-auto">
                    @if(count($categories))
                        <table class="uk-table uk-table-striped uk-table-hover">
                            <caption>دسته‌ها</caption>
                            <thead style="border-top: 1px solid lightgray">
                            <tr>
                                <th>نام دسته</th>
                                <th>آیدی</th>
                                <th>دسته مادر</th>
                                <th>نامک</th>
                                <th>حذف</th>
                                <th>بازدید</th>
                            </tr>
                            </thead>
                            <tfoot style="border-top: 1px solid lightgray">
                            <tr>
                                <th>نام تگ</th>
                                <th>نامک</th>
                                <th>حذف</th>
                                <th>بازدید</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->parent }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <form action="{{ route('Category > Delete', $category->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="uk-button uk-button-small uk-button-danger" @if($category->id == 1) disabled @endif>حذف</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('Category > Archive', $category->slug) }}">بازدید ({{ count($category->article) }})</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links('pagination::uikit-dark') }}
                    @else
                        <div class="uk-alert-warning" uk-alert>
                            <a class="uk-alert-close" style="color: black" uk-close></a>
                            <p>هیچ دسته‌بندی در سیستم ثبت نشده است.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
