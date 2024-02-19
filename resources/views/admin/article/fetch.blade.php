@php
    $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
@endphp
@foreach($articles as $article)
<tr>
    <td class="uk-form-width-medium">{{ $article->title }}</td>
    @php
        $jalaliDate = new Verta($article->created_at);
        $jalaliDate->timezone('Asia/Tehran');
        $jalaliDate = Verta::instance($article->created_at);
        $jalaliDate = Facades\Verta::instance($article->created_at);
    @endphp
    <td class="uk-form-width-small">{{ $jalaliDate }}</td>
    <td class="uk-form-width-small">{{ $article->user->name . ' ' . $article->user->family }}</td>
    <td>@foreach($article->category as $category) <a href="{{ route('Category > Archive', $category->slug) }}" class="uk-text-meta">{{ $category->name }}@if(!$loop->last) {{', '}} @endif</a> @endforeach</td>
    <td>@foreach($article->tag as $tag) <a href="{{ route('Tag > Archive', $tag->slug) }}" class="uk-text-meta">{{ $tag->name }}@if(!$loop->last) {{', '}} @endif</a>@endforeach</td>
    <td>{{ $article->views }}</td>
    <td>
        @if($article->state == 0)
            <div class="state-drafted"></div>
        @elseif($article->state == 1)
            <div class="state-published"></div>
        @else
            <div class="state-deleted"></div>
        @endif
    </td>
    @if($user->CanEditOtherUserArticles() || $article->user->id == $user->id)
    <td>
        <a href="{{ route('Article > Edit', $article->id) }}">
            <button class="uk-button uk-button-small uk-button-secondary">ویرایش</button>
        </a>
    </td>
    @endif
    <td>
        @if($article->state == -1)
            <form action="{{ route('Article > Restore', $article->id) }}" method="POST">
                @csrf
                <button type="submit" class="uk-button uk-button-small uk-button-primary">بازیابی</button>
            </form>
        @else
            -
        @endif
    </td>
    <td>
        @if($user->CanRemoveOtherUsersArticles() || $article->user->id == $user->id)
        @if($article->state == -1)
        <form action="{{ route('Article > Delete Permanently', $article->id) }}" method="POST">
            @csrf
            <button type="submit" class="uk-button uk-button-text uk-text-danger">حذف همیشگی</button>
        @else
        <form action="{{ route('Article > Delete', $article->id) }}" method="POST">
            @csrf
            <button type="submit" class="uk-button uk-button-text uk-text-danger">حذف</button>
        @endif
        </form>
        @endif
    </td>
    <td>
        <a href="{{ route('Article > Single', $article->slug) }}">بازدید</a>
    </td>
</tr>
@endforeach
