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
          <li class="dropdown"><a class="nav-link menu-title link-nav {{ Route::currentRouteName()=='index' ? 'active' : '' }}" href="{{route('index')}}"><i data-feather="home"> </i><span>{{ trans('lang.Dashboards') }}</span></a></li>

          <li class="dropdown">
            <a class="nav-link menu-title {{request()->route()->getPrefix() == '/starter-kit' ? 'active' : '' }}" href="#">
              <i data-feather="anchor"></i><span>{{ trans('lang.Starter kit') }}</span>
              <div class="according-menu"><i class="fa fa-angle-{{request()->route()->getPrefix() == '/starter-kit' ? 'down' : 'right' }}"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: {{ request()->route()->getPrefix() == '/starter-kit' ? 'block;' : 'none;' }}">
              <li>
                <a class="submenu-title {{ in_array(Route::currentRouteName(), ['layout-light', 'layout-dark']) ? 'active' : '' }}" href="#">
                  Color Version
                  <div class="according-menu"><i class="fa fa-angle-{{ in_array(Route::currentRouteName(), ['layout-light', 'layout-dark']) ? 'down' : 'right' }}"></i></div>
                </a>
                <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['layout-light', 'layout-dark']) ? 'block' : 'none;' }};">
                    <li><a href="{{route('layout-light')}}" class="{{ Route::currentRouteName()=='layout-light' ? 'active' : '' }}">Layout Light</a></li>
                    <li><a href="{{route('layout-dark')}}" class="{{ Route::currentRouteName()=='layout-dark' ? 'active' : '' }}">Layout Dark</a></li>
                </ul>
              </li>

              <li>
                <a class="submenu-title {{ in_array(Route::currentRouteName(), ['layout-rtl', 'dark-rtl-layout', 'semi-dark', 'semi-dark-rtl', 'compact-layout', 'compact-rtl-layout', 'layout-box', 'vertical-layout', 'vertical-rtl-layout', 'dark-box-layout', 'vertical-box-layout', 'compact-dark-layout', 'compact-dark-rtl-layout']) ? 'active' : '' }}" href="#">
                  Page layout
                  <div class="according-menu"><i class="fa fa-angle-{{ in_array(Route::currentRouteName(), ['layout-rtl', 'dark-rtl-layout', 'semi-dark', 'semi-dark-rtl', 'compact-layout', 'compact-rtl-layout', 'layout-box', 'vertical-layout', 'vertical-rtl-layout', 'dark-box-layout', 'vertical-box-layout', 'compact-dark-layout', 'compact-dark-rtl-layout']) ? 'down' : 'right' }}"></i></div>
                </a>
                <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['layout-rtl', 'dark-rtl-layout', 'semi-dark', 'semi-dark-rtl', 'compact-layout', 'compact-rtl-layout', 'layout-box', 'vertical-layout', 'vertical-rtl-layout', 'dark-box-layout', 'vertical-box-layout', 'compact-dark-layout', 'compact-dark-rtl-layout']) ? 'block' : 'none;' }};">
                    <li><a href="{{route('layout-rtl')}}" class="{{ Route::currentRouteName()=='layout-rtl' ? 'active' : '' }}">RTL Layout</a></li>
                    <li><a href="{{route('dark-rtl-layout')}}" class="{{ Route::currentRouteName()=='dark-rtl-layout' ? 'active' : '' }}">Dark & RTL Layout</a></li>
                    <li><a href="{{route('semi-dark')}}" class="{{ Route::currentRouteName()=='semi-dark' ? 'active' : '' }}">Semi Dark</a></li>
                    <li><a href="{{route('semi-dark-rtl')}}" class="{{ Route::currentRouteName()=='semi-dark-rtl' ? 'active' : '' }}">Semi Dark & RTL</a></li>
                    <li><a href="{{route('compact-layout')}}" class="{{ Route::currentRouteName()=='compact-layout' ? 'active' : '' }}">Compact Layout</a></li>
                    <li><a href="{{route('compact-rtl-layout')}}" class="{{ Route::currentRouteName()=='compact-rtl-layout' ? 'active' : '' }}">Compact & RTL Layout</a></li>
                    <li><a href="{{route('layout-box')}}" class="{{ Route::currentRouteName()=='layout-box' ? 'active' : '' }}">Box Layout</a></li>
                    <li><a href="{{route('vertical-layout')}}" class="{{ Route::currentRouteName()=='vertical-layout' ? 'active' : '' }}">Vertical Layout</a></li>
                    <li><a href="{{route('vertical-rtl-layout')}}" class="{{ Route::currentRouteName()=='vertical-rtl-layout' ? 'active' : '' }}">Vertical & RTL Layout</a></li>
                    <li><a href="{{route('dark-box-layout')}}" class="{{ Route::currentRouteName()=='dark-box-layout' ? 'active' : '' }}">Dark & box Layout</a></li>
                    <li><a href="{{route('vertical-box-layout')}}" class="{{ Route::currentRouteName()=='vertical-box-layout' ? 'active' : '' }}">Vetical Box Layout</a></li>
                    <li><a href="{{route('compact-dark-layout')}}" class="{{ Route::currentRouteName()=='compact-dark-layout' ? 'active' : '' }}">Compact Dark Layout</a></li>
                    <li><a href="{{route('compact-dark-rtl-layout')}}" class="{{ Route::currentRouteName()=='compact-dark-rtl-layout' ? 'active' : '' }}">Compact Dark & RTL Layout</a></li>
                </ul>
              </li>

              <li>
                <a class="submenu-title {{ in_array(Route::currentRouteName(), ['footer-light', 'footer-dark', 'footer-fixed']) ? 'active' : '' }}" href="#">
                  Footers
                  <div class="according-menu"><i class="fa fa-angle-{{ in_array(Route::currentRouteName(), ['footer-light', 'footer-dark', 'footer-fixed']) ? 'down' : 'right' }}"></i></div>
                </a>
                <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['footer-light', 'footer-dark', 'footer-fixed']) ? 'block' : 'none;' }};">
                    <li><a href="{{route('footer-light')}}" class="{{ Route::currentRouteName()=='footer-light' ? 'active' : '' }}">Footer Light</a></li>
                    <li><a href="{{route('footer-dark')}}" class="{{ Route::currentRouteName()=='footer-dark' ? 'active' : '' }}">Footer Dark</a></li>
                    <li><a href="{{route('footer-fixed')}}" class="{{ Route::currentRouteName()=='footer-fixed' ? 'active' : '' }}">Footer Fixed</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</header>