@extends('public.template')

@section('meta')
	<title>روزنامه صمت - آرشیو روزنامه</title>
    <meta name="description" content="آرشیو کامل شماره های روزنامه صمت">
    <meta name="robots" content="index, follow">
@endsection

@section('content')
@if($request->has('version') && isset($single_version))
<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-1">
        <h2 class="uk-card-title"><span class="uk-float-left"><a href="{{ route('Archive > Newspaper') }}">بازگشت</a></span> نسخه شماره {{ $single_version }}</h2>
        <div uk-grid>
            @php $pn  = 0; @endphp
            @foreach($pages as $p)
            @php $pn += 1; @endphp
                @if (count($p) == 2)
                <div class="uk-card uk-card-default uk-card-body uk-width-1-4@m uk-width-1-2@s uk-padding-small">
                    <img src="{{ $base }}/{{ $single_version }}/{{ $p[0] }}" style="width: 100%" alt="{{ "روزنامه صمت شماره $single_version - صفحه $pn" }}" loading="lazy">
                    <div class="uk-width-1-1 uk-margin-small-top uk-text-center">
                        <a href="{{ $base }}/{{ $single_version }}/{{ $p[1] }}" download><button class="uk-button">دانلود</button></a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        
    </div>
</div>
@else
<style>
    .shimmer {
        animation-duration: 2.2s;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
        animation-name: shimmer;
        animation-timing-function: linear;
        background: #ddd;
        background: linear-gradient(to right, #F6F6F6 8%, #F0F0F0 18%, #F6F6F6 33%);
        background-size: 1200px 100%;
    }
    .shimmer img {
        width: 100% !important;
    }


    @-webkit-keyframes shimmer {
        0% {
            background-position: -100% 0;
        }
        100% {
            background-position: 100% 0;
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -1200px 0;
        }
        100% {
            background-position: 1200px 0;
        }
    }
</style>
<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-1">
        <h2 class="uk-card-title">آرشیو روزنامه</h2>
        <div uk-grid>
            @php
                $c = 0;
            @endphp

            @foreach($versions as $number)
                <?php
                    $c += 1;
                    if ($c == 1) {
                        if(\Illuminate\Support\Facades\Cache::has('newspaper')) {
                            $newspaper = (object) [
                                'cover' => env('ARCHIVE_BASE_URL')."$number/frontpage_$number.jpg",
                                'title' => 'روزنامه صمت شماره ' . $number,
                                'slug' => route('Archive > Newspaper') . "?version=$number",
                            ];
                            \Illuminate\Support\Facades\Cache::put('newspaper', $newspaper, now()->addMinutes(40));
                        }

                    }
                ?>
            <div class="uk-card uk-card-default uk-card-body uk-width-1-3@m uk-width-1-2@s">
                <div class="shimmer" style="width: 158px; height: 212px;">
                    <img src="{{ $base }}/{{ $number }}/1.jpg" alt="روزنامه صمت شماره {{ $number }}" loading="lazy">
                </div>
                <div class="uk-width-1-1 uk-margin-small-top uk-text-center">
                    <h3>شماره {{ $number }}</h3>
                    <a href="?version={{ $number }}"><button class="uk-button">نمایش</button></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection