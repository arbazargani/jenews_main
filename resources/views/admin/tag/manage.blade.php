@extends('admin.template')

@section('meta')
<title>ایجاد برچسب جدید</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                ایجاد برچسب
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
                    <form class="uk-grid-small uk-position-relative uk-grid" uk-grid="" action="{{ route('Tag > Submit') }}" method="POST">
                        @csrf
                        <div class="uk-inline uk-width-1-1 uk-first-column">
                            <input type="text" name="name" id="name" placeholder="عنوان" class="uk-input form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required style="padding-left: 40px;">
                        </div>
                        <div class="uk-inline uk-width-1-1 uk-first-column">
                            <input type="text" name="slug" id="slug" placeholder="نامک" class="uk-input form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" style="padding-left: 40px;">
                        </div>
                        <div class="uk-inline uk-width-1-1 uk-first-column">
                            <button type="submit" class="uk-button uk-button-primary uk-border-rounded">انتشار</button>
                        </div>
                    </form>
                </div>
                <div class="uk-width-2-3@m uk-width-1-1@s uk-overflow-auto">
                    @if(count($tags))
                        <table class="uk-table uk-table-striped uk-table-hover">
                            <caption>برچسب‌ها</caption>
                            <thead style="border-top: 1px solid lightgray">
                            <tr>
                                <th>نام تگ</th>
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
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>
                                        <form action="{{ route('Tag > Delete', $tag->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="uk-button uk-button-small uk-button-danger">حذف</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('Tag > Archive', $tag->slug) }}">بازدید ({{ count($tag->article) }})</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $tags->links("pagination::uikit-dark") }}
                    @else
                        <div class="uk-alert-warning" uk-alert>
                            <a class="uk-alert-close" syle="color: black;" uk-close></a>
                            <p>هیچ برچسبی در سیستم ثبت نشده است.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
