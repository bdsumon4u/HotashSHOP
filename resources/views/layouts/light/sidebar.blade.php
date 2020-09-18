<header class="main-nav">
  <div class="logo-wrapper">
    <a href="{{route('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
  </div>
  <div class="logo-icon-wrapper"><a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
  <nav>
    <div class="main-navbar">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="mainnav">
        <ul class="nav-menu custom-scrollbar">
          <li class="back-btn">
            <a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
            <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-title">
            <div>
              <h6 class="lan-1"> {{ trans('lang.General') }}</h6>
              <p class="lan-2">{{ trans('lang.Dashboards & layout.') }}</p>
            </div>
          </li>
          <li>
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='index' ? 'active' : '' }}" href="{{route('index')}}">
              <i data-feather="home"> </i>
              <span>{{ trans('lang.Dashboards') }}</span>
            </a>
          </li>

          <li>
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.slides.index' ? 'active' : '' }}" href="{{route('admin.slides.index')}}">
              <i data-feather="image"> </i>
              <span>Slides</span>
            </a>
          </li>

          <li>
            <a class="nav-link menu-title link-nav {{ request()->is('admin/orders*') ? 'active' : '' }}" href="{{route('admin.orders.index')}}">
              <i data-feather="check"> </i>
              <span>Orders</span>
            </a>
          </li>

          <li class="dropdown">
            <a class="nav-link menu-title {{request()->is('admin/products*') ? 'active' : '' }}" href="#">
              <i data-feather="shopping-cart"> </i><span>Products</span>
              <div class="according-menu"><i class="fa fa-angle-{{request()->is('admin/products*') ? 'down' : 'right' }}"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: {{ request()->is('admin/products*') ? 'block;' : 'none;' }}">
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.products.index' ? 'active' : '' }}" href="{{route('admin.products.index')}}">
                  <span>All Products</span>
                </a>
              </li>
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.products.create' ? 'active' : '' }}" href="{{route('admin.products.create')}}">
                  <span>Create Product</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li>
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.categories.index' ? 'active' : '' }}" href="{{route('admin.categories.index')}}">
              <i data-feather="server"> </i>
              <span>Categories</span>
            </a>
          </li>
          <li>
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.brands.index' ? 'active' : '' }}" href="{{route('admin.brands.index')}}">
              <i data-feather="wind"> </i>
              <span>Brands</span>
            </a>
          </li>
          <li>
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.images.index' ? 'active' : '' }}" href="{{route('admin.images.index')}}">
              <i data-feather="image"> </i>
              <span>Images</span>
            </a>
          </li>
          
          <li class="dropdown">
            <a class="nav-link menu-title {{request()->is('admin/products*') ? 'active' : '' }}" href="#">
              <i data-feather="shopping-cart"> </i><span>Products</span>
              <div class="according-menu"><i class="fa fa-angle-{{request()->is('admin/products*') ? 'down' : 'right' }}"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: {{ request()->is('admin/products*') ? 'block;' : 'none;' }}">
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.products.index' ? 'active' : '' }}" href="{{route('admin.products.index')}}">
                  <span>All Products</span>
                </a>
              </li>
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.products.create' ? 'active' : '' }}" href="{{route('admin.products.create')}}">
                  <span>Create Product</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="dropdown">
            <a class="nav-link menu-title {{request()->is('admin/home-sections*') ? 'active' : '' }}" href="#">
              <i data-feather="layers"> </i><span>Home Sections</span>
              <div class="according-menu"><i class="fa fa-angle-{{request()->is('admin/home-sections*') ? 'down' : 'right' }}"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: {{ request()->is('admin/home-sections*') ? 'block;' : 'none;' }}">
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.home-sections.index' ? 'active' : '' }}" href="{{route('admin.home-sections.index')}}">
                  <span>All Sections</span>
                </a>
              </li>
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.home-sections.create' ? 'active' : '' }}" href="{{route('admin.home-sections.create')}}">
                  <span>Create Section</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="dropdown">
            <a class="nav-link menu-title {{request()->is('admin/pages*') ? 'active' : '' }}" href="#">
              <i data-feather="layers"> </i><span>Pages</span>
              <div class="according-menu"><i class="fa fa-angle-{{request()->is('admin/pages*') ? 'down' : 'right' }}"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: {{ request()->is('admin/pages*') ? 'block;' : 'none;' }}">
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.pages.index' ? 'active' : '' }}" href="{{route('admin.pages.index')}}">
                  <span>All Pages</span>
                </a>
              </li>
              <li>
                <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.pages.create' ? 'active' : '' }}" href="{{route('admin.pages.create')}}">
                  <span>Create Page</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li>
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.menus.index' ? 'active' : '' }}" href="{{route('admin.menus.index')}}">
              <i data-feather="menu"> </i>
              <span>Menus</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</header>