<!-- CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="{{ asset('assets/css/select2-1.min.css') }}">

<!-- Script -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="{{ asset('assets/js/select2-1.min.js') }}"></script>

<style>
  #select-tags {
    width: 100%;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    padding-left: 0px;
  }
  .select2-selection__choice__remove {
    opacity: 0;
    width: 100%;
    left: 0 !important;
    right: 0 !important;
    margin: 0px auto !important;
    transition: opacity 0.2s;
  }
  .select2-selection__choice__remove:hover {
    opacity: 0.7;
  }
  .select2-container--default .select2-selection--multiple {
      background-color: #393939 !important;
      border: 1px solid #585858 !important;
  }
  .select2-container--default .select2-selection--single {
      background-color: #393939 !important;
      border: 1px solid #585858 !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: white !important;
  }
  .select2-container--default .select2-results>.select2-results__options {
      background-color: #393939 !important;
      border: 1px solid #585858 !important;
  }
  .select2-results__option--selectable {
      color: white;
  }
  .select2-results__option--selectable:hover {
      /*background: #1a202c !important;*/
  }

</style>

<select id="select-tags" name="tags[]" multiple placeholder="جستجوی تگ" autocomplete="off">
    @if(isset($article))
        @foreach($article->tag()->get() as $tag)
            <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
        @endforeach
    @endif
</select>
<!-- <select class="uk-select" id='selUser' style="width: 100%" multiple="multiple"></select> -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){

$( "#select-tags" ).select2({
  ajax: {
    url: "{{ route('Tag > AjaxV2') }}",
    type: "post",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        _token: CSRF_TOKEN,
        search: params.term // search term
      };
    },
    processResults: function (response) {
      return {
        results: response
      };
    },
    cache: true
  }

});

});
</script>
