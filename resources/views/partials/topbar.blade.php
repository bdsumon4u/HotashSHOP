<div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
            @foreach($menuItems as $item)
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="{{ url($item->href) }}">{{ $item->name }}</a>
            </div>
            @endforeach
            <div class="topbar__spring"></div>
            <div class="topbar__item">
                <div class="topbar-dropdown">
                    <button class="topbar-dropdown__btn" type="button">My Account
                        <svg width="7px" height="5px">
                            <use xlink:href="{{ asset('strokya/images/sprite.svg#arrow-rounded-down-7x5') }}"></use>
                        </svg>
                    </button>
                    <div class="topbar-dropdown__body">
                        <!-- .menu -->
                        <ul class="menu menu--layout--topbar">
                            <li><a href="account.html">Login</a></li>
                            <li><a href="account.html">Register</a></li>
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Addresses</a></li>
                        </ul><!-- .menu / end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>