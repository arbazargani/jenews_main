@extends('admin.template')

@section('meta')
<title>مدیریت دیدگاه‌ها</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                مدیریت دیدگاه‌ها
            </h2>
            <div class="uk-grid-small uk-position-relative uk-grid" uk-grid>
                <div class="uk-width-1-1">
                    @if(count($comments))
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped uk-table-hover">
                                {{--<caption>آخرین مقالات</caption>--}}
                                <thead>
                                <tr>
                                    <th>محتوای دیدگاه</th>
                                    <th>تاریخ انتشار</th>
                                    <th>مقاله مرتبط</th>
                                    <th>نویسنده</th>
                                    <th>عملیات</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>محتوای دیدگاه</th>
                                    <th>تاریخ انتشار</th>
                                    <th>مقاله مرتبط</th>
                                    <th>نویسنده</th>
                                    <th>عملیات</th>
                                    <th>حذف</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>
                                            <span style="white-space: nowrap;
                                                         overflow: hidden;
                                                         text-overflow: ellipsis;
                                            ">{{ substr($comment->content, 0 , 100) . '...' }}</span>
                                        </td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td><a href="{{ route('Article > Single', $comment->article->slug) }}">{{ substr($comment->article->title, 0, 90) . '...' }}</a></td>
                                        <td>{{ $comment->name . ' ' . $comment->family }}</td>
                                        <td>
                                            @if($comment->approved)
                                                <form action="{{ route('Comment > Unapprove', $comment->id) }}" method="post">
                                                    @csrf
                                                    <button class="uk-button uk-button-secondary" type="submit">تعلیق</button>
                                                </form>
                                            @else
                                                <form action="{{ route('Comment > Approve', $comment->id) }}" method="post">
                                                    @csrf
                                                    <button class="uk-button uk-button-default" type="submit" style="border: 1px solid #f0506e; color: #f0506e;">تایید</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Comment > Delete', $comment->id) }}" method="post">
                                                @csrf
                                                <button class="uk-button uk-button-danger" type="submit">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="uk-alert-warning" uk-alert>
                            <a class="uk-alert-close" style="color: black" uk-close></a>
                            <p>دیدگاهی در سیستم ثبت نشده است.</p>
                        </div>
                    @endif
                    {{ $comments->links("pagination::uikit-dark") }}
                </div>
            </div>
        </div>
    </div>
@endsection
