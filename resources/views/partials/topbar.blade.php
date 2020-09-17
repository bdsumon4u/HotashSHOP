<div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
            @foreach($menuItems as $item)
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ url($item->href) }}">{{ $item->name }}</a>
            </div>
            @endforeach
            <div class="topbar__spring"></div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ url('/track-order') }}">Track Order</a>
            </div>
        </div>
    </div>
</div>