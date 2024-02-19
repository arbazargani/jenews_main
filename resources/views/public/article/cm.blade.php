<div class="uk-card uk-card-body uk-border-rounded">
    <h2 class="uk-card-title">افزودن دیدگاه</h2>
    @if($errors->any())
        <div class="uk-alert uk-alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif
    <form class="uk-form" action="{{ route('Comment > Submit', $article[0]->id) }}" method="post">
        @csrf
        @if(!Auth::check())
            <div class="uk-grid-match uk-grid-small uk-text-center uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>
                <div>
                    <input id="name" type="text" placeholder="نام"
                           class="uk-input form-control @error('name') uk-form-danger @enderror uk-width-1-1@m"
                           name="name"
                           required autocomplete="name" value="{{ old('name') }}">
                </div>
                <div>
                    <input id="family" type="text" placeholder="نام خانوادگی"
                           class="uk-input form-control @error('family') uk-form-danger @enderror"
                           name="family"
                           required autocomplete="family" value="{{ old('family') }}">
                </div>
            </div>
            <div class="uk-grid-match uk-grid-small uk-text-center uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>
                <div>
                    <input id="email" type="text" placeholder="ایمیل"
                           class="uk-input form-control @error('email') uk-form-danger @enderror"
                           name="email"
                           required autocomplete="email" value="{{ old('email') }}">
                </div>
                <div>
                    <input id="website" type="text" placeholder="وبسایت"
                           class="uk-input form-control @error('website') uk-form-danger @enderror"
                           name="website"
                           autocomplete="website" value="{{ old('website') }}">
                </div>
            </div>
        @else
            <div class="uk-grid-match uk-grid-small uk-text-right" uk-grid>
                <div class="uk-width-1-2@m">
                    <p>
                        ثبت دیدگاه با کاربر {{ Auth::user()->username }}. | <a
                            href="{{ route('User > Logout') }}">خروج؟</a>
                    </p>
                </div>
                <div class="uk-width-1-2@m">
                    <input id="website" type="text" placeholder="وبسایت"
                           class="uk-input form-control @error('website') uk-form-danger @enderror"
                           name="website"
                           autocomplete="website" value="{{ old('website') }}">
                </div>
            </div>
        @endif
        <div class="uk-grid-match uk-grid-small uk-child-width-1-1 uk-text-right" uk-grid>
            <div>
                                <textarea id="content" class="uk-input uk-height-medium" uk-input form-control
                                          @error('content') uk-form-danger
                                          @enderror name="content" rows="8" cols="80" style="width: 100%;"
                                          placeholder="نظرتان را بنویسید.">{{ old('content')  }}</textarea>
                <hr>
                <button type="submit" class="uk-button uk-button-primary">ثبت</button>
            </div>
        </div>
    </form>
</div>
@if(count($comments) > 0)
    <div class="uk-card uk-card-body uk-border-rounded">
        <h3 class="uk-card-title">دیدگاه کاربران</h3>
        <hr class="uk-divider-small">
    @foreach($comments as $comment)
        @if($comment->approved)
            <div class="uk-comment uk-comment-primary uk-margin-small uk-border-rounded">
                <div class="uk-comment-header uk-text-meta">
                    <p>
                        <span class="uk-text-bold">{{ $comment->name . ' ' . $comment->family }}</span>
                        در تاریخ
                        <span class="uk-text-bold">{{ $comment->created_at }}</span>
                    </p>
                </div>
                <div class="uk-comment-body" style="border-right: 3px solid rgba(74,123,227,0.11)">
                    <p class="uk-margin-small-right">
                        {{ $comment->content }}
                    </p>
                </div>
            </div>
        @endif
    @endforeach
    </div>
@else
    <div class="uk-alert uk-alert-warning">
        <span>دیدگاهی برای این نوشته ثبت نشده است.</span>
    </div>
@endif
