<div class="site-header__topbar topbar text-nowrap">
    <div class="topbar__container container">
        <div class="topbar__row">
            <div class="topbar__item topbar__item--link">
                <img style="height: 35px;" class="img-responsive " src="https://www.himelshop.com/front_asset/call-now.gif" alt="Call 7colors" title="7colors">&nbsp;
                <a style="font-family: monospace;" class="topbar-link" href="tel:{{ $company->phone ?? '' }}">{{ $company->phone ?? '' }}</a>
            </div>
            @foreach($menuItems as $item)
            <div class="topbar__item topbar__item--link d-none d-md-flex">
                <a class="topbar-link" href="{{ url($item->href) }}">{!! $item->name !!}</a>
            </div>
            @endforeach
            <marquee class="d-flex align-items-center h-100 mx-2" behavior="" direction="">{!! $scroll_text ?? '' !!}</marquee>
            <div class="topbar__spring"></div>
            @if($show_option->track_order ?? false)
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ url('/track-order') }}">Track Order</a>
            </div>
            @endif
        </div>
    </div>
</div>