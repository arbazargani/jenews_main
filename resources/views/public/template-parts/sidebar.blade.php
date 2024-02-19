<div class="uk-background-default uk-border-rounded">

    <!-- socket - search -->
    <div class="sidebar-element">
        <div class="uk-card uk-card-hover uk-card-body">
            <!-- <h3 class="uk-card-title uk-text-meta">جستجو</h3> -->
            <!-- <hr class="uk-divider-small"> -->
            <form class="uk-grid-small" action="/" uk-grid>
                <div class="uk-width-expand">
                    <input class="uk-input" type="text" name="query" id="query" placeholder="جستجو">
                </div>
                <div class="uk-width-auto">
                    <button class="uk-button uk-button-primary theme-background-green" type="submit"><span
                            uk-icon="search"></span></button>
                </div>
            </form>
            <hr>
            <a href="{{ route('Old Search') }}" class="uk-button uk-button-muted" type="submit"><span
                    uk-icon="arrow-right"></span> جستجو در اخبار قدیمی</a>
        </div>
    </div>

    <!-- Advertise socket - section 001 -->
    <div class="sidebar-element" id="advertise-socket-sidebar-right-001">
        @if(count($advertises) > 0)
            @foreach($advertises->where('socket', 'sidebar-right-001')->all() as $advertise)
                @if($advertise->just_admin && !Auth::check())
                    @break
                @else
                    <div class="uk-card uk-card-hover uk-card-body @if($advertise->mobile_only) uk-hidden@s @endif">
                        {!! $advertise->content !!}
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <!-- Advertise socket - section 001 -->

    <!-- socket - LeadArticle article -->
    <div class="sidebar-element">
        <div class="uk-card uk-card-hover uk-card-body">
            <h3 class="uk-card-title uk-text-meta">
                <span class="socket-title-icon" uk-icon="quote-right"></span>
                <span>سر مقاله</span>
            </h3>
            <hr class="uk-divider-small">
            @include('public.template-parts.leadArticle')
        </div>
    </div>
    <!-- socket - LeadArticle article -->

    <!-- socket - latest/popular -->
    <div class="sidebar-element">
        <div class="uk-card uk-card-hover uk-card-body">

            <!-- tabs -->
            <ul class="uk-flex-center" uk-tab>
                <li><a href="uk-active">جدیدترین</a></li>
                <li class=""><a href="">پیشنهادی</a></li>
                <li class=""><a href="">پربازدید</a></li>
            </ul>
            <!-- tabs -->

            <!-- contents -->
            <ul class="uk-switcher">
                <li>
                    @if(count($latestArticles) > 0)
                        <ul class="uk-list uk-list-muted">
                            @foreach($latestArticles as $item)
                                <li>
                                    <span class="item-iterator">{{ $loop->iteration }}</span>
                                    <a class="uk-link-reset uk-text-meta theme-color-hover-red"
                                       href="{{ route('Article > Single', $item->slug) }}"
                                       target="_blank">{{ $item->title }}
                                        @if($item->type == 'video')
                                            <span uk-icon="ratio: 1; icon: video-camera" style="vertical-align: middle"></span>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="uk-text-meta uk-text-warning">مقاله‌ای در سیستم موجود نیست.</span>
                    @endif
                </li>

                <li>
                    @if(count($notPopularArticles) > 0)
                        <ul class="uk-list uk-list-muted">
                            @foreach($notPopularArticles as $item)
                                <li>
                                    <span class="item-iterator">{{ $loop->iteration }}</span>
                                    <a class="uk-link-reset uk-text-meta theme-color-hover-red"
                                       href="{{ route('Article > Single', $item->slug) }}"
                                       target="_blank">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="uk-text-meta uk-text-warning">مقاله‌ای در سیستم موجود نیست.</span>
                    @endif
                </li>

                <li>
                    @if(count($popularArticles) > 0)
                        <ul class="uk-list uk-list-muted">
                            @foreach($popularArticles as $item)
                                <li>
                                    <span class="item-iterator">{{ $loop->iteration }}</span>
                                    <a class="uk-link-reset uk-text-meta theme-color-hover-red"
                                       href="{{ route('Article > Single', $item->slug) }}"
                                       target="_blank">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="uk-text-meta uk-text-warning">مقاله‌ای در سیستم موجود نیست.</span>
                    @endif
                </li>
            </ul>
            <!-- contents -->
        </div>
    </div>
    <!-- socket - latest/popular -->

    <!-- Advertise socket - section 002 -->
    <div class="sidebar-element" id="advertise-socket-sidebar-right-002">
        @if(count($advertises) > 0)
            @foreach($advertises->where('socket', 'sidebar-right-002')->all() as $advertise)
                @if($advertise->just_admin && !Auth::check())
                    @break
                @else
                    <div class="uk-card uk-card-hover uk-card-body @if($advertise->mobile_only) uk-hidden@s @endif">
                        {!! $advertise->content !!}
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <!-- Advertise socket - section 002 -->

</div>
