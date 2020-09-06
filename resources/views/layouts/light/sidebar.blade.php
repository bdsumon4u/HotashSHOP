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

          <li class="dropdown">
            <a class="nav-link menu-title {{request()->route()->getPrefix() == '/starter-kit' ? 'active' : '' }}" href="#">
              <i data-feather="anchor"></i><span>{{ trans('lang.Starter kit') }}</span>
              <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/starter-kit' ? 'down' : 'right' }}"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: {{ request()->route()->getPrefix() == '/starter-kit' ? 'block;' : 'none;' }}">
              
            </ul>
          </li>

          <li>
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.slides.index' ? 'active' : '' }}" href="{{route('admin.slides.index')}}">
              <i data-feather="image"> </i>
              <span>Slides</span>
            </a>
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
            <a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='admin.products.index' ? 'active' : '' }}" href="{{route('admin.products.index')}}">
              <i data-feather="shopping-cart"> </i>
              <span>Products</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</header>