@extends('admin.template')

@section('meta')
    <title>.ویرایش گالری تصاویر</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 class="uk-h2 tm-heading-fragment">
                ویرایش گالری
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('Gallery > Update', $gallery->id) }}" method="post" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
                @csrf
                <input type="hidden" name="timestamp" value="{{ $gallery->timestamp }}">
                <div class="uk-width-1-2@m">
                    <label class="uk-form-label">عنوان</label>
                    <input class="uk-input" type="text" name="title" value="{{ $gallery->title }}" required>
                </div>
                <div class="uk-width-1-2">
                    <input required type="file" class="form-control" name="images[]" placeholder="files" multiple>
                </div>
                <span>آیدی گالری: {{ $gallery->timestamp }}</span>
                <!-- <button type="submit" class="uk-button uk-button-primary" name="button">ذخیره</button> -->
            </form>
        </div>
        <div class="uk-container uk-width-1-2@m uk-margin-medium-top">
        @if($gallery !== false)
            <div class="uk-position-relative uk-visible-toggle uk-light uk-margin-small" tabindex="-1" uk-slider="center: true">
                <ul class="uk-slider-items uk-grid">
                @foreach (explode("|", $gallery->content) as $url)
                    <li class="uk-width-3-4">
                        <div class="uk-panel">
                            <img src="/storage/uploads/gallery/{!! $url !!}" alt="">
                        </div>
                    </li>
                @endforeach
                </ul>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

            </div>
            @endif
        </div>
    </div>
@endsection
