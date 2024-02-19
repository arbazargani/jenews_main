@extends('admin.template')

@section('meta')
    <title>ویرایش خبر</title>
@endsection

@section('content')
    <div class="tm-main uk-section uk-section-secondary">
        <div class="uk-container uk-container-large">
            <h2 class="uk-h2 tm-heading-fragment">
                ویرایش خبر
            </h2>
            @if($errors->any())
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form class="uk-grid-small uk-position-relative uk-grid" uk-grid=""
                  action="{{ route('Article > Update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="uk-width-2-3@m">
                    <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-bottom">
                        <input type="text" name="rootitr" id="rootitr" placeholder="روتیتر"
                               class="uk-input form-control @error('rootitr') is-invalid @enderror"
                               value="{{ $article->rootitr  }}" style="padding-left: 40px;" autofocus>
                        <hr>
                        <textarea name="lead" id="lead" placeholder="لید خبر خود را وارد کنید."
                                  class="uk-textarea form-control @error('lead') is-invalid @enderror"
                                  style="padding-left: 40px;" rows="2">{{ $article->lead }}</textarea>
                        <hr>
                        <input type="text" name="title" id="title" placeholder="عنوان"
                               class="uk-input form-control @error('title') is-invalid @enderror"
                               value="{{ $article->title  }}" required style="padding-left: 40px;" autofocus>
                    </div>
                    <div class="uk-inline uk-width-1-1 uk-first-column">
                        <textarea name="content" id="content" placeholder="محتوای اصلی مقاله خود را وارد کنید."
                                  class="uk-textarea form-control @error('content') is-invalid @enderror"
                                  style="padding-left: 40px;" rows="7">{{ $article->content }}</textarea>
                    </div>
                    <hr>
                    <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded">
                        <h3 class="uk-card-title">تنظیمات</h3>
                        <div class="uk-inline uk-width-1-1 uk-first-column uk-margin-small-bottom">
                            <!-- meta description -->
                            <div class="">
                                <label class="uk-form-label" for="meta-description">اسنیپت (Meta:description)</label>
                                <textarea type="text" name="meta-description" id="meta-description"
                                          placeholder="توضیحات متا"
                                          class="uk-textarea form-control @error('title') is-invalid @enderror"
                                          value="{{ old('title') }}" required style="padding-left: 40px;"
                                          onkeydown="checkLength();">{{ $article->meta_description }}</textarea>
                                <style>
                                    #meta-description-state {
                                        width: 0%;
                                        height: 4px !important;
                                    }
                                </style>
                                <div id="meta-description-state" style="width: 100%; height: 10px!important"></div>
                                <p>
                                <ul>
                                    <li>حداقل ۱۲۰ کاراکتر باشد.</li>
                                    <li>حداکثر ۱۶۰ کاراکتر باشد.</li>
                                    <li>بهتر است شامل کلمات کلیدی باشد.</li>
                                </ul>
                                </p>
                                <script>
                                    function checkLength() {
                                        var len = document.getElementById('meta-description').value.length;
                                        if (len >= 1 && len <= 70) {
                                            document.getElementById('meta-description-state').setAttribute('style', 'background: red; width: 30%;');
                                        } else if (len >= 70 && len <= 120) {
                                            document.getElementById('meta-description-state').setAttribute('style', 'background: orange; width: 40%;');
                                        } else if (len >= 120 && len <= 160) {
                                            document.getElementById('meta-description-state').setAttribute('style', 'background: green; width: 100%;');
                                        } else (
                                            document.getElementById('meta-description-state').setAttribute('style', 'background: red; width: 100%;')
                                        )
                                    }
                                </script>
                            </div>
                            <!-- meta robots -->
                            <div>
                                <label class="uk-form-label" for="meta-robots">خزنده (Meta:robots)</label>
                                <select class="uk-select" name="meta-robots">
                                    @php
                                        $robots = ['index, follow', 'noindex', 'nofollow', 'noindex, nofollow'];
                                    @endphp
                                    @foreach ($robots as $index)
                                        @if($article->meta_robots == $index)
                                            <option value="{{ $index }}" selected>{{ $index }}</option>
                                        @else
                                            <option value="{{ $index }}">{{ $index }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="uk-grid">
                                <div class="uk-width-1-2@m">
                                    <label class="uk-form-label" for="type">نوع محتوا</label>
                                    <select class="uk-select" id="type" name="type">
                                        <option value="text" @if($article->type == 'text') selected @endif>خبر</option>
                                        <option value="video" @if($article->type == 'video') selected @endif>فیلم
                                        </option>
                                    </select>
                                    <div class="uk-alert-danger" uk-alert>
                                        <p><span uk-icon="youtube"></span> در صورتی که نوع خبر فیلم می‌باشد، از بخش
                                            تصویر نوشته در سمت چپ ویدیو خود را انتخاب نمایید.</p>
                                    </div>
                                    <!-- article meta canonical -->
                                    <div>
                                        <label class="uk-form-label" for="meta_canonical">کنونیکال</label>
                                        <input type="text" name="meta_canonical" id="meta_canonical"
                                               placeholder="لینک کنونیکال"
                                               class="uk-input form-control @error('meta_canonical') is-invalid @enderror"
                                               style="padding-left: 40px;" value="{{ $article->meta_canonical }}">
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <!-- article writer -->
                                    <div>
                                        <label class="uk-form-label" for="writer">نویسنده خبر</label>
                                        <input type="text" name="writer" id="writer" placeholder="نویسنده خبر"
                                               class="uk-input form-control @error('writer') is-invalid @enderror"
                                               style="padding-left: 40px;" value="{{ $article->writer }}">
                                    </div>
                                    <!-- article gallery -->
                                    <div>
                                        <label class="uk-form-label" for="gallery">گالری خبر</label>
                                        <input type="text" name="gallery" id="gallery" placeholder="گالری خبر"
                                               class="uk-input form-control @error('gallery') is-invalid @enderror"
                                               style="padding-left: 40px;" value="{{ $article->gallery_id }}">
                                    </div>
                                    <!-- article external url -->
                                    <div>
                                        <label class="uk-form-label" for="external_url">لینک خارجی خبر</label>
                                        <input type="text" name="external_url" id="external_url"
                                               placeholder="لینک خارجی خبر"
                                               class="uk-input form-control @error('external_url') is-invalid @enderror"
                                               style="padding-left: 40px;" value="{{ $article->external_url }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3@m">
                    <div class="uk-container">
                        <button type="submit" name="update"
                                class="uk-button uk-button-medium uk-button-secondary uk-border-rounded" value="1">
                            بروزرسانی
                        </button>
                        @if($article->state == 1)
                            <button type="submit" name="draft"
                                    class="uk-button uk-button-medium uk-button-danger uk-border-rounded" value="1">
                                پیش‌نویس
                            </button>
                        @elseif($article->state == -1)
                            <button type="submit" name="draft"
                                    class="uk-button uk-button-medium uk-button-danger uk-border-rounded" value="1">
                                پیش‌نویس
                            </button>
                            <button type="submit" name="publish"
                                    class="uk-button uk-button-medium uk-button-primary uk-border-rounded" value="1">
                                انتشار
                            </button>
                        @elseif($article->state == 0)
                            <button type="submit" name="publish"
                                    class="uk-button uk-button-medium uk-button-primary uk-border-rounded" value="1">
                                انتشار
                            </button>
                        @endif
                    </div>
                    <hr class="uk-divider-icon">

                    <div class="uk-container">
                        @php
                            $d = new Verta($article->created_at);
                        @endphp
                        <label class="uk-form-label" for="created_year">سال</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="created_year" name="created_year">
                                @for($i = ($d->year)-10; $i <= ($d->year)+10; $i++)
                                    <option value="{{ $i }}" @if($d->year == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="uk-container">
                        <label class="uk-form-label" for="created_month">ماه</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="created_month" name="created_month">
                                <option value="1" @if($d->month == 1) selected @endif>فروردین</option>
                                <option value="2" @if($d->month == 2) selected @endif>اردیبهشت</option>
                                <option value="3" @if($d->month == 3) selected @endif>خرداد</option>
                                <option value="4" @if($d->month == 4) selected @endif>تیر</option>
                                <option value="5" @if($d->month == 5) selected @endif>مرداد</option>
                                <option value="6" @if($d->month == 6) selected @endif>شهریور</option>
                                <option value="7" @if($d->month == 7) selected @endif>مهر</option>
                                <option value="8" @if($d->month == 8) selected @endif>آبان</option>
                                <option value="9" @if($d->month == 9) selected @endif>آذز</option>
                                <option value="10" @if($d->month == 10) selected @endif>دی</option>
                                <option value="11" @if($d->month == 11) selected @endif>بهمن</option>
                                <option value="12" @if($d->month == 12) selected @endif>اسفند</option>
                            </select>
                        </div>
                    </div>
                    <div class="uk-container">
                        <label class="uk-form-label" for="created_day">روز</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="created_day" name="created_day">
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" @if($d->day == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="uk-container">
                        <label class="uk-form-label" for="created_hour">ساعت</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="created_hour" name="created_hour">
                                @for($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}"
                                            @if($d->hour == $i || $d->hour == 0 . "$i") selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="uk-container">
                        <label class="uk-form-label" for="created_minute">دقیقه</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="created_minute" name="created_minute">
                                @for($i = 0; $i <= 59; $i++)
                                    <option value="{{ $i }}" @if($d->minute == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <h4 class="uk-h4 tm-heading-fragment">دسته‌بندی</h4>
                        <select name="categories[]" id="categories" class="uk-select" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @foreach($article->category()->get() as $activeCategory)
                                        @if($activeCategory->id == $category->id )
                                        selected="selected"
                                    @endif
                                    @endforeach
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <hr class="uk-divider-small">

                        <ul uk-accordion class="uk-disabled">
                            <li class="uk-close">
                                <a class="uk-accordion-title" href="#">افزودن دسته <span class="uk-text-meta">(غیرفعال)</span></a>
                                <div class="uk-accordion-content">
                                    <p style="display: none" id="cat_area"></p>
                                    <p id="cat_preview"></p>

                                    <input class="uk-input uk-margin" type="text" id="user_category">
                                    <a class="uk-button uk-button-link uk-float-left" onclick="add_cat()"><span
                                            uk-icon="arrow-right"></span> افزودن دسته</a>

                                    <script>
                                        function add_cat() {
                                            var name = document.getElementById('user_category').value;
                                            document.getElementById('cat_area').innerHTML += '<input class="uk-invisible uk-meta" type="text" name="new_categories[]" id="new_category_' + name + '" value="' + name + '">';
                                            document.getElementById('cat_preview').innerHTML += '<a id="cat_preview_' + name + '" style="color: #9fb8cd" onclick="' + 'remove_cat(\'new_category_' + name + '\'), ' + 'remove_cat(\'cat_preview_' + name + '\')"><span uk-icon="close"></span>' + name + ' </a>';
                                            document.getElementById('user_category').value = '';
                                        }

                                        function remove_cat(id) {
                                            var elem = document.getElementById(id);
                                            return elem.parentNode.removeChild(elem);
                                        }
                                    </script>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <h4 class="uk-h4 tm-heading-fragment">برچسب‌ها</h4>
                        {{--                        <select name="tags[]" id="tags" class="uk-select" multiple>--}}
                        {{--                            @foreach($tags as $tag)--}}
                        {{--                                <option value="{{ $tag->id }}"--}}
                        {{--                                                                    @foreach($article->tag()->get() as $activeTag)--}}
                        {{--                                                                        @if($activeTag->id == $tag->id )--}}
                        {{--                                                                            selected="selected"--}}
                        {{--                                                                        @endif--}}
                        {{--                                                                    @endforeach--}}
                        {{--                                >{{ $tag->name }}</option>--}}
                        {{--                            @endforeach--}}
                        {{--                        </select>--}}

                        @include('admin.template-parts.Select2Dotjs')

                        <hr class="uk-divider-small">

                        <ul uk-accordion>
                            <li class="uk-close">
                                <a class="uk-accordion-title" href="#">افزودن برچسب</a>
                                <div class="uk-accordion-content">
                                    <p style="display: none" id="tag_area"></p>
                                    <p id="tag_preview"></p>

                                    <input class="uk-input uk-margin" type="text" id="user_tag">
                                    <a class="uk-button uk-button-link uk-float-left" onclick="add_tag()"><span
                                            uk-icon="arrow-right"></span> افزودن برچسب</a>

                                    <script>
                                        function add_tag() {
                                            var name = document.getElementById('user_tag').value;
                                            document.getElementById('tag_area').innerHTML += '<input class="uk-invisible uk-meta" type="text" name="new_tags[]" id="new_tag_' + name + '" value="' + name + '">';
                                            document.getElementById('tag_preview').innerHTML += '<a id="tag_preview_' + name + '" style="color: #9fb8cd" onclick="' + 'remove_tag(\'new_tag_' + name + '\'), ' + 'remove_tag(\'tag_preview_' + name + '\')"><span uk-icon="close"></span>' + name + ' </a>';
                                            document.getElementById('user_tag').value = '';
                                        }

                                        function remove_tag(id) {
                                            var elem = document.getElementById(id);
                                            return elem.parentNode.removeChild(elem);
                                        }
                                    </script>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-container">
                        <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded">
                            <h4 class="uk-h4 tm-heading-fragment">تصویر نوشته</h4>
                            @if($article->cover)
                                <div class="uk-container uk-align-center">
                                    @if($article->type == 'video')
                                        <video width="320" height="240" controls>
                                            <source src="{{ $article->video_url }}">
                                            Your browser does not support the video tag.
                                        </video>
                                        <br>
                                        <img src="/storage/{{ $article->cover }}" alt="" style="max-width: 100%;">
                                    @else
                                        <img src="{{ $article->cover }}" alt="" style="max-width: 100%;">
                                    @endif
                                    <hr>
                                    <label><input class="uk-checkbox" type="checkbox" name="remove_cover" value="1"> حذف
                                        تصویر نوشته</label>
                                    <hr>
                                    {{--</div>--}}
                                    @endif
                                    {{--<input type="file" name="cover" id="cover">--}}
                                    <div class='uk-grid uk-child-width-1-2'>
                                        <div>
                                            <input type="text" id="image_label" class="uk-input uk-text-meta"
                                                   name="cover"
                                                   aria-label="Image" aria-describedby="button-image"
                                                   content="{{ $article->cover }}">
                                        </div>
                                        <div class="input-group-append">
                                            <button class="uk-button uk-button-secondary" type="button"
                                                    id="button-image"
                                                    name="cover_url">انتخاب
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {

                                        document.getElementById('button-image').addEventListener('click', (event) => {
                                            event.preventDefault();

                                            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                                        });
                                    });

                                    // set file link
                                    function fmSetLink($url) {
                                        document.getElementById('image_label').value = $url;
                                    }
                                </script>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
