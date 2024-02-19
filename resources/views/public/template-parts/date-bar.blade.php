<div style="background: #004c21; padding: 10px !important" class="uk-section">
@php
    $jdate = new Verta();
    $jdate = verta();
    $jdate = $jdate->format('l %d %B، %Y');
@endphp
<p class="uk-text-meta fa-num" style="color: white; margin-right: 2%">{{ $jdate }}</p>
</div>
