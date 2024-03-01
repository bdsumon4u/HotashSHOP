<div class="site-header__topbar topbar">
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
            <div class="topbar__spring"></div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ url('/track-order') }}">Track Order</a>
            </div>
        </div>
    </div>
</div>