<div class="uk-background-default uk-border-rounded">
    <!-- socket - newsppaer -->
    <div class="sidebar-element uk-margin-remove-top">
        <div class="uk-card uk-card-hover uk-card-body">
            <h3 class="uk-card-title uk-text-meta">
                <span class="socket-title-icon" uk-icon="quote-right"></span>
                <a href="{{ route('Category > Archive', 'آرشیو-روزنامه') }}" target="_blank">
                    <span>آرشیو روزنامه</span>
                </a>
            </h3>
            <hr class="uk-divider-small">
            <a href="{{ route('Article > Single', $newspaper_latest->slug) }}" target="_blank">
                <img class="uk-border-rounded" style="width: 100%;" src="{{ $newspaper_latest->cover }}" alt="{{ $newspaper_latest->title }}">
            </a>
            <hr>
            <a href="{{ route('Article > Single', $newspaper_latest->slug) }}" target="_blank">
                <button class="uk-button uk-margin-small-top uk-text-center uk-button-text"><span
                        uk-icon="arrow-right"></span>
                    {{ $newspaper_latest->title }}
                </button>
            </a>
        </div>
    </div>
    <!-- socket - newsppaer -->

    <!-- Advertise socket - section 001 -->
    <div class="sidebar-element" id="advertise-socket-sidebar-001">
        @if(count($advertises) > 0)
            @foreach($advertises->where('socket', 'sidebar-001')->all() as $advertise)
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

    <!-- Advertise socket - section 002 -->
    <div class="sidebar-element" id="advertise-socket-sidebar-002">
        @if(count($advertises) > 0)
            @foreach($advertises->where('socket', 'sidebar-002')->all() as $advertise)
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

    <!-- Advertise socket - section 003 -->
    <div class="sidebar-element" id="advertise-socket-sidebar-003">
        @if(count($advertises) > 0)
            @foreach($advertises->where('socket', 'sidebar-003')->all() as $advertise)
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
    <!-- Advertise socket - section 003 -->

    <!-- Advertise socket - section 004 -->
    <div class="sidebar-element" id="advertise-socket-sidebar-004">
        @if(count($advertises) > 0)
            @foreach($advertises->where('socket', 'sidebar-004')->all() as $advertise)
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
    <!-- Advertise socket - section 004 -->

</div>
