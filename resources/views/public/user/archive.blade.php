@extends('public.template')

@section('meta')
	<title>آرشیو نوشته‌های {{ $user[0]->username . ' ' . $settings['title_delimiter']->value . $settings['website_name']->value }}</title>
        <meta name="description" content='پروفایل {{ $user[0]->name . " " . $user[0]->family }}'>
    <meta name="robots" content="index, follow">
@endsection

@section('content')
<ul class="uk-breadcrumb uk-margin-medium-right">
	<li><a href="{{ route('Home') }}">خانه</a></li>
	<li class="uk-disabled"><a>پروفایل</a></li>
	<li class="uk-disabled"><a>{{ $user[0]->username }}</a></li>
</ul>

<div class="uk-article">
    <!-- meta box -->
    <div class="article uk-margin uk-background-default uk-border-rounded">
        <div class="uk-container" uk-grid>
            <div class="uk-width-1-3@m">
                <img class="uk-border-rounded" src="https://smtnews.ir/assets/image/ghost.png" style="width: auto;">
            </div>
            <div class="uk-width-2-3@m">
                <p>
                    <p>
                        <h1 class="uk-margin-medium-top uk-text-lead"><span class="uk-icon-button" uk-icon="user"></span> {{ "{$user[0]->name} {$user[0]->family}" }}</h1>
                    </p>
                    <p>
                        <span class="uk-icon-button" uk-icon="file-text"></span>  <span class="uk-text-lighter uk-text-emphasis">تعدا نوشته‌ها: {{ count($user[0]->article->all()) }}</span>
                    </p>
                    <p>
                        <span class="uk-icon-button" uk-icon="mail"></span>  <span class="uk-text-lighter uk-text-emphasis">{{ $user[0]->email }}</span>
                    </p>
                </p>
            </div>
        </div>
    </div>
    <!-- meta box -->

    <!-- articles -->
    @if(count($PaginatedArticles) > 0)
    @foreach($PaginatedArticles as $article)
    <div class="article uk-margin @if($loop->even) uk-background-default @else uk-background-secondary uk-light @endif uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-large">
        <div class="uk-container" uk-grid>
            <div class="uk-width-1-3@m">
            <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><img class="uk-border-rounded" src="{{ $article->cover }}" style="width: auto;"></a>
            </div>
            <div class="uk-width-2-3@m">
                <p>
                    <a class="uk-link-reset" href="{{ route('Article > Single', $article->slug) }}"><h3 class="uk-margin-small-top uk-text-lead">{{ $article->title }}</h3></a>
                    <hr class="uk-divider-small">
                    <div uk-grid>
                        <div class="uk-width-5-6">
                            <p class="uk-text-truncate">
                                <span>{{ $article->meta_description }}</span>
                            </p>
                        </div>

                        <div class="uk-width-1-6">
                            <a class="uk-bage uk-badge" href="{{ route('Article > Single', $article->slug) }}"><span uk-icon="arrow-right"></span></a>
                        </div>
                    </div>

                </p>
            </div>
        </div>
    </div>
    @endforeach

    <!-- paginator -->
    {{ $PaginatedArticles->links("pagination::uikit") }}
    <!-- paginator -->

    @else
    <div class="article uk-margin uk-background-default uk-border-rounded uk-box-shadow-small uk-box-shadow-hover-large">
        <div class="uk-container uk-padding-remove">
            <div class="uk-alert uk-alert-warning">
                <p>این کاربر تابحال مقاله‌ای منتشر نکرده است.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- articles -->
</div>

@endsection
