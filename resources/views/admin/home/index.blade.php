@extends('admin.template')

@section('meta')
<title>پنل مدیریت</title>
@endsection

@section('content')
<div class="uk-padding uk-section uk-section-secondary">
    <h2>پنل مدیریت</h2>
    <!-- system info -->
    <div class="uk-section uk-section-secondary uk-light uk-background-secondary uk-padding uk-margin-large-bottom">

        <!-- permanent alert -->
        <div class="uk-alert uk-alert-warning">
            <p><span uk-icon="icon: bookmark"></span>
                مطالب پس از گذشت ۵ دقیقه در صفحه اصلی نمایش داده می‌شوند.
                <a href="{{ route('Cache > Clear') }}">پاکسازی کش بصورت دستی</a></p>
        </div>
        <!-- permanent alert -->

        <h3><span uk-icon="pencil"></span> محتوا</h3>
        <hr>
        <div class="uk-child-width-1-3@m" uk-grid>
            <div>
                <h4><span uk-icon="file-pdf"></span> مقالات</h4>
                <hr class="uk-divider-small">
                <div>
                    <p><span uk-icon="arrow-right"></span> تعداد کل مقالات: <span class="uk-badge">{{ $articles['all'] }}</span></p>
                    <p class="uk-text-success"><span uk-icon="arrow-right"></span> مقالات منتشر شده: <span class="uk-badge">{{ $articles['published'] }}</span></p>
                    <p class="uk-text-warning"><span uk-icon="arrow-right"></span> مقالات پیش نویس: <span class="uk-badge">{{ $articles['drafts'] }}</span></p>
                    <p class="uk-text-danger"><span uk-icon="trash"></span> مقالات حذف شده: <span class="uk-badge">{{ $pages['deleted'] }}</span></p>
                </div>
            </div>
            <div>
                <h4><span uk-icon="file-text"></span> صفحات</h4>
                <hr class="uk-divider-small">
                <div>
                    <p><span uk-icon="arrow-right"></span> تعداد کل صفحات: <span class="uk-badge">{{ $pages['all'] }}</span></p>
                    <p class="uk-text-success"><span uk-icon="arrow-right"></span> صفحات منتشر شده: <span class="uk-badge">{{ $pages['published'] }}</span></p>
                    <p class="uk-text-warning"><span uk-icon="arrow-right"></span> صفحات پیش نویس: <span class="uk-badge">{{ $pages['drafts'] }}</span></p>
                    <p class="uk-text-danger"><span uk-icon="trash"></span> صفحات حذف شده: <span class="uk-badge">{{ $pages['deleted'] }}</span></p>
                </div>
            </div>
            <div>
                <h4><span uk-icon="comment"></span> دیدگاه‌ها</h4>
                <hr class="uk-divider-small">
                <div>
                    <p><span uk-icon="arrow-right"></span> تعداد کل دیدگاه‌ها: <span class="uk-badge">{{ $comments['all'] }}</span></p>
                    <p><span uk-icon="arrow-right"></span> دیدگاه‌های تایید شده: <span class="uk-badge">{{ $comments['approved'] }}</span></p>
                    <p><span uk-icon="arrow-right"></span> دیدگاه‌های معلق: <span class="uk-badge">{{ $comments['unapproved'] }}</span></p>
                </div>
            </div>
        </div>

    </div>
    <!-- populars -->

    <div class="uk-section uk-section-primary uk-light uk-background-primary uk-border-rounded uk-padding uk-margin-large-bottom">
        <h3><span uk-icon="star"></span> مقالات محبوب</h3>
        <hr>
        <div>
            @if(count($articles['popular']) > 0)
            <table class="uk-table uk-table-divider">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>نویسنده</th>
                        <th>بازدید</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($articles['popular'] as $article)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('Article > Single', $article->slug) }}" target="_blank">{{ $article->title }}</a></td>
                        <td>{{ $article->user->username }}</td>
                        <td>{{ $article->views }}</td>
                    </tr>
            @endforeach
                </tbody>
            </table>
            @else
                <div class="uk-alert">
                    محتوایی برای نمایش موجود <نیست></نیست>.
                </div>
            @endif
        </div>
    </div>
    <!-- populars -->

    <!-- analytics -->
    <div class="uk-section uk-section-secondary uk-light uk-background-secondary uk-padding uk-margin-large-bottom">
        <h3><span uk-icon="users"></span> کاربران</h3>
        <hr>
        <div class="uk-child-width-1-2@m" uk-grid>

            <!-- geolocation -->
            <div>
                <h4><span uk-icon="location"></span> جئوگرافی</h4>
                <hr class="uk-divider-small">
                <div>
                    <script>
                         google.charts.load('current', {
                            'packages':['geochart'],
                            // Note: you will need to get a mapsApiKey for your project.
                            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
                            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
                        });
                        google.charts.setOnLoadCallback(drawRegionsMap);

                        function drawRegionsMap() {
                            var data = google.visualization.arrayToDataTable([
                            ['Country', 'Popularity'],
                            ['Germany', 200],
                            ['United States', 300],
                            ['Brazil', 400],
                            ['Canada', 500],
                            ['France', 600],
                            ['RU', 700]
                            ]);

                            var options = {};

                            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

                            chart.draw(data, options);
                        }
                    </script>
                    <div id="regions_div" class="chart-wrapper" style="width:357px; height:223px; margin: 2px;"></div>
                </div>
            </div>
            <!-- geolocation -->

            <!-- sex -->
            <div>
                <h4><span uk-icon="happy"></span> جنسیت</h4>
                <hr class="uk-divider-small">
                <div>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                            ['Sex', 'Percentage'],
                            ['Male',     83],
                            ['Female',      17]
                            ]);

                            var options = {
                            // title: 'Sex'
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    </script>
                    <div id="piechart" class="chart-wrapper" style="width:357px; height:223px; margin: 2px;"></div>
                </div>
            </div>
            <!-- sex -->

            <!-- browser -->
            <div>
                <h4><span uk-icon="world"></span> مرورگر</h4>
                <hr class="uk-divider-small">
                <div>
                <script language = "JavaScript">
                    function drawChart() {
                        // Define the chart to be drawn.
                        var data = google.visualization.arrayToDataTable([
                        ['Browser', 'Percentage'],
                        ['Chrome',  60],
                        ['Firefox',  20],
                        ['Edge',  3],
                        ['Opera',  10],
                        ['Other',  7]
                        ]);

                        var options = {title: ''};

                        // Instantiate and draw the chart.
                        var chart = new google.visualization.ColumnChart(document.getElementById('col_chart'));
                        chart.draw(data, options);
                    }
                    google.charts.setOnLoadCallback(drawChart);
                </script>
                        <div id="col_chart" class="chart-wrapper" style="width:357px; height:223px; margin: 2px;"></div>
                </div>
            </div>
            <!-- browser -->

        </div>
    </div>
    <!-- analytics -->

    <!-- admin alerts, logs -->
    <div class="uk-section uk-section-secondary uk-light uk-background-secondary uk-padding uk-margin-large-bottom">
        <h3><span uk-icon="bell"></span> اعلانات</h3>
        <hr>
        <div class="uk-child-width-1-2@m" uk-grid>

            <!-- alerts -->
            <div>
                <h4><span uk-icon="mail"></span> یادداشت</h4>
                <hr class="uk-divider-small">
                <ul>
                    <li>افزودن متا در تنظیمات صفحه اصلی</li>
                    <li class="uk-text-warning">افزودن فایل منیجر پنل</li>
                    <li class="uk-text-warning">بهنیه سازی ویو ارور ها</li>
                    <li>طراحی سیستم یادداشت مدیر</li>
                    <li class="uk-text-danger">طراحی مدل آنالیز کاربران</li>
                </ul>
                <h4><span uk-icon="mail"></span> چک لیست</h4>
                <hr class="uk-divider-small">
                <input class="uk-checkbox" type="checkbox" checked> <label><strike>تم دارک مود</strike></label>
                <br/>
                <input class="uk-checkbox" type="checkbox" checked> <label><strike>متد حذف اصلی</strike></label>
                <br/>
                <input class="uk-checkbox" type="checkbox"> <label>افزودن متا در تنظیمات صفحه اصلی</label>
                <br/>
            </div>
            <!-- alerts -->

            <!-- logs -->
            <div>
                <h4><span uk-icon="print"></span> لاگ‌های سیستم</h4>
                <hr class="uk-divider-small">
                @if(empty($logs['file']))
                    <p>موردی ثبت نشده است.</p>
                @else
                <div class="uk-height-medium">
                    <span class="uk-text-meta" >updated on: {{ $logs['lastModified'] }} | {{ round($logs['size'] / 1024) }}KB</p>
                    <div class="js-wrapper">
                        <div uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper">
                           <div style="direction:ltr; text-align:left;">
                                <pre>{{ $logs['file'] }}</pre>
                           </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!-- logs -->

        </div>
    </div>
    <!-- admin alerts, logs -->


</div>
@endsection
