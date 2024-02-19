@extends('public.feed')

@section('content')

@foreach($articles as $article)
    <entry>
        <title>{{ $article->title }}</title>
        <link href="{{ urlencode(route('Article > Single', $article->slug)) }}"/>
        <id>http://article/{{ urlencode($article->slug) }}</id>
        @if($article->user->name)<author>
            <name>{{ $article->user->name . $article->user->family }}</name>
        </author>@endif
        <published><?php echo date('Y-m-d\TH:i:sP', strtotime($article->created_at)); ?></published>
        <updated><?php echo date('Y-m-d\TH:i:sP', strtotime($article->updated_at)); ?></updated>
        <summary>{{ $article->meta_description }}</summary>
    </entry>
@endforeach

@endsection
