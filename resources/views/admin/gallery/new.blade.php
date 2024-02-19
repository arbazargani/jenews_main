@extends('admin.template')

@section('meta')
    <title>افزودن گالری تصاویر</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 class="uk-h2 tm-heading-fragment">
                افزودن گالری
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('Gallery > Submit') }}" method="post" class="uk-grid-small" enctype="multipart/form-data" uk-grid>
                @csrf
                <input type="hidden" name="timestamp" value="@php echo time(); @endphp">
                <div class="uk-width-1-2@m">
                    <label class="uk-form-label">عنوان</label>
                    <input class="uk-input" type="text" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="uk-width-1-2">
                    <input required type="file" class="form-control" name="images[]" placeholder="files" multiple>
                </div>
                <button type="submit" class="uk-button uk-button-primary" name="button">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
