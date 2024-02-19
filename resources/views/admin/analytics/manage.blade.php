@extends('admin.template')

@section('meta')
<title>حقوق و دستمزد</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 id="lightbox" class="uk-h2 tm-heading-fragment">
                پنل آمار
            </h2>
            @php
                $jdate = new Verta();
                $jdate = verta();
                $jdate = $jdate->format('%d %B، %Y');
            @endphp
            <table class="uk-table">
                <caption>اخبار امروز {{ $jdate }}</caption>
                <thead>
                    <tr>
                        <th>کاربر</th>
                        <th>تعداد اخبار</th>
                        <th>تعداد بازدید</th>
                        <th>میانگین بازدید‌ها</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>کاربر</th>
                        <th>تعداد اخبار</th>
                        <th>تعداد بازدید</th>
                        <th>میانگین بازدید‌ها</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($analytics as $user => $data)
                    <tr>
                        <td>{{ $user }}</td>
                        <td>{{ $data['count'] }}</td>
                        <td>{{ $data['hits'] }}</td>
                        <td>{{ $data['average'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
