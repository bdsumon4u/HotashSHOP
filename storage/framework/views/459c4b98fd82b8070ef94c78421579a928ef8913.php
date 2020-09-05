<header class="main-nav">
  <div class="logo-wrapper">
    <a href="<?php echo e(route('/')); ?>"><img class="img-fluid for-light" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt=""><img class="img-fluid for-dark" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt=""></a>
    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
  </div>
  <div class="logo-icon-wrapper"><a href="<?php echo e(route('/')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a></div>
  <nav>
    <div class="main-navbar">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="mainnav">
        <ul class="nav-menu custom-scrollbar">
          <li class="back-btn">
            <a href="<?php echo e(route('/')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a>
            <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-title">
            <div>
              <h6 class="lan-1"> <?php echo e(trans('lang.General')); ?></h6>
              <p class="lan-2"><?php echo e(trans('lang.Dashboards & layout.')); ?></p>
            </div>
          </li>
          <li class="dropdown"><a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='index' ? 'active' : ''); ?>" href="<?php echo e(route('index')); ?>"><i data-feather="home"> </i><span><?php echo e(trans('lang.Dashboards')); ?></span></a></li>

          <li class="dropdown">
            <a class="nav-link menu-title <?php echo e(request()->route()->getPrefix() == '/starter-kit' ? 'active' : ''); ?>" href="#">
              <i data-feather="anchor"></i><span><?php echo e(trans('lang.Starter kit')); ?></span>
              <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/starter-kit' ? 'down' : 'right'); ?>"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: <?php echo e(request()->route()->getPrefix() == '/starter-kit' ? 'block;' : 'none;'); ?>">
              <li>
                <a class="submenu-title <?php echo e(in_array(Route::currentRouteName(), ['layout-light', 'layout-dark']) ? 'active' : ''); ?>" href="#">
                  Color Version
                  <div class="according-menu"><i class="fa fa-angle-<?php echo e(in_array(Route::currentRouteName(), ['layout-light', 'layout-dark']) ? 'down' : 'right'); ?>"></i></div>
                </a>
                <ul class="nav-sub-childmenu submenu-content" style="display: <?php echo e(in_array(Route::currentRouteName(), ['layout-light', 'layout-dark']) ? 'block' : 'none;'); ?>;">
                    <li><a href="<?php echo e(route('layout-light')); ?>" class="<?php echo e(Route::currentRouteName()=='layout-light' ? 'active' : ''); ?>">Layout Light</a></li>
                    <li><a href="<?php echo e(route('layout-dark')); ?>" class="<?php echo e(Route::currentRouteName()=='layout-dark' ? 'active' : ''); ?>">Layout Dark</a></li>
                </ul>
              </li>

              <li>
                <a class="submenu-title <?php echo e(in_array(Route::currentRouteName(), ['layout-rtl', 'dark-rtl-layout', 'semi-dark', 'semi-dark-rtl', 'compact-layout', 'compact-rtl-layout', 'layout-box', 'vertical-layout', 'vertical-rtl-layout', 'dark-box-layout', 'vertical-box-layout', 'compact-dark-layout', 'compact-dark-rtl-layout']) ? 'active' : ''); ?>" href="#">
                  Page layout
                  <div class="according-menu"><i class="fa fa-angle-<?php echo e(in_array(Route::currentRouteName(), ['layout-rtl', 'dark-rtl-layout', 'semi-dark', 'semi-dark-rtl', 'compact-layout', 'compact-rtl-layout', 'layout-box', 'vertical-layout', 'vertical-rtl-layout', 'dark-box-layout', 'vertical-box-layout', 'compact-dark-layout', 'compact-dark-rtl-layout']) ? 'down' : 'right'); ?>"></i></div>
                </a>
                <ul class="nav-sub-childmenu submenu-content" style="display: <?php echo e(in_array(Route::currentRouteName(), ['layout-rtl', 'dark-rtl-layout', 'semi-dark', 'semi-dark-rtl', 'compact-layout', 'compact-rtl-layout', 'layout-box', 'vertical-layout', 'vertical-rtl-layout', 'dark-box-layout', 'vertical-box-layout', 'compact-dark-layout', 'compact-dark-rtl-layout']) ? 'block' : 'none;'); ?>;">
                    <li><a href="<?php echo e(route('layout-rtl')); ?>" class="<?php echo e(Route::currentRouteName()=='layout-rtl' ? 'active' : ''); ?>">RTL Layout</a></li>
                    <li><a href="<?php echo e(route('dark-rtl-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='dark-rtl-layout' ? 'active' : ''); ?>">Dark & RTL Layout</a></li>
                    <li><a href="<?php echo e(route('semi-dark')); ?>" class="<?php echo e(Route::currentRouteName()=='semi-dark' ? 'active' : ''); ?>">Semi Dark</a></li>
                    <li><a href="<?php echo e(route('semi-dark-rtl')); ?>" class="<?php echo e(Route::currentRouteName()=='semi-dark-rtl' ? 'active' : ''); ?>">Semi Dark & RTL</a></li>
                    <li><a href="<?php echo e(route('compact-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='compact-layout' ? 'active' : ''); ?>">Compact Layout</a></li>
                    <li><a href="<?php echo e(route('compact-rtl-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='compact-rtl-layout' ? 'active' : ''); ?>">Compact & RTL Layout</a></li>
                    <li><a href="<?php echo e(route('layout-box')); ?>" class="<?php echo e(Route::currentRouteName()=='layout-box' ? 'active' : ''); ?>">Box Layout</a></li>
                    <li><a href="<?php echo e(route('vertical-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='vertical-layout' ? 'active' : ''); ?>">Vertical Layout</a></li>
                    <li><a href="<?php echo e(route('vertical-rtl-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='vertical-rtl-layout' ? 'active' : ''); ?>">Vertical & RTL Layout</a></li>
                    <li><a href="<?php echo e(route('dark-box-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='dark-box-layout' ? 'active' : ''); ?>">Dark & box Layout</a></li>
                    <li><a href="<?php echo e(route('vertical-box-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='vertical-box-layout' ? 'active' : ''); ?>">Vetical Box Layout</a></li>
                    <li><a href="<?php echo e(route('compact-dark-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='compact-dark-layout' ? 'active' : ''); ?>">Compact Dark Layout</a></li>
                    <li><a href="<?php echo e(route('compact-dark-rtl-layout')); ?>" class="<?php echo e(Route::currentRouteName()=='compact-dark-rtl-layout' ? 'active' : ''); ?>">Compact Dark & RTL Layout</a></li>
                </ul>
              </li>

              <li>
                <a class="submenu-title <?php echo e(in_array(Route::currentRouteName(), ['footer-light', 'footer-dark', 'footer-fixed']) ? 'active' : ''); ?>" href="#">
                  Footers
                  <div class="according-menu"><i class="fa fa-angle-<?php echo e(in_array(Route::currentRouteName(), ['footer-light', 'footer-dark', 'footer-fixed']) ? 'down' : 'right'); ?>"></i></div>
                </a>
                <ul class="nav-sub-childmenu submenu-content" style="display: <?php echo e(in_array(Route::currentRouteName(), ['footer-light', 'footer-dark', 'footer-fixed']) ? 'block' : 'none;'); ?>;">
                    <li><a href="<?php echo e(route('footer-light')); ?>" class="<?php echo e(Route::currentRouteName()=='footer-light' ? 'active' : ''); ?>">Footer Light</a></li>
                    <li><a href="<?php echo e(route('footer-dark')); ?>" class="<?php echo e(Route::currentRouteName()=='footer-dark' ? 'active' : ''); ?>">Footer Dark</a></li>
                    <li><a href="<?php echo e(route('footer-fixed')); ?>" class="<?php echo e(Route::currentRouteName()=='footer-fixed' ? 'active' : ''); ?>">Footer Fixed</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</header><?php /**PATH H:\Cuba\laravel\starter-kit\resources\views/layouts/light/sidebar.blade.php ENDPATH**/ ?>