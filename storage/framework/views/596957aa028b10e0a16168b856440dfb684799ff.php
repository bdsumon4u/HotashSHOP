<header class="main-nav">
  <div class="logo-wrapper">
    <a href="<?php echo e(route('/')); ?>">
      <span class="h4 m-0"><?php echo e($company->name); ?></span>
      <!-- <img class="img-fluid for-light" src="<?php echo e(asset($logo->desktop ?? '')); ?>" alt=""> -->
      <!-- <img class="img-fluid for-dark" src="<?php echo e(asset($logo->desktop ?? '')); ?>" alt=""> -->
    </a>
    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
  </div>
  <div class="logo-icon-wrapper">
    <a href="<?php echo e(route('/')); ?>">
      <img class="img-fluid" src="<?php echo e(asset($logo->favicon ?? '')); ?>" width="36" height="36" alt="">
    </a>
  </div>
  <nav>
    <div class="main-navbar">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="mainnav">
        <ul class="nav-menu custom-scrollbar">
          <li class="back-btn">
            <a href="<?php echo e(route('/')); ?>">
              <img class="img-fluid" src="<?php echo e(asset($logo->favicon ?? '')); ?>" height="36" width="36" alt="">
            </a>
            <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-title">
            <div>
              <h6 class="lan-1"> <?php echo e(trans('lang.General')); ?></h6>
            </div>
          </li>
          <li>
            <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.home' ? 'active' : ''); ?>" href="<?php echo e(route('admin.home')); ?>">
              <i data-feather="home"> </i>
              <span>Dashboard</span>
            </a>
          </li>

          <li>
            <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.slides.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.slides.index')); ?>">
              <i data-feather="image"> </i>
              <span>Slides</span>
            </a>
          </li>

          <li>
            <a class="nav-link menu-title link-nav <?php echo e(request()->is('admin/orders*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.orders.index')); ?>">
              <i data-feather="check"> </i>
              <span>Orders</span>
            </a>
          </li>

          <li>
            <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.categories.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.categories.index')); ?>">
              <i data-feather="server"> </i>
              <span>Categories</span>
            </a>
          </li>
          <li>
            <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.brands.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.brands.index')); ?>">
              <i data-feather="wind"> </i>
              <span>Brands</span>
            </a>
          </li>
          <li>
            <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.images.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.images.index')); ?>">
              <i data-feather="image"> </i>
              <span>Images</span>
            </a>
          </li>
          
          <li class="dropdown">
            <a class="nav-link menu-title <?php echo e(request()->is('admin/products*') ? 'active' : ''); ?>" href="#">
              <i data-feather="shopping-cart"> </i><span>Products</span>
              <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->is('admin/products*') ? 'down' : 'right'); ?>"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: <?php echo e(request()->is('admin/products*') ? 'block;' : 'none;'); ?>">
              <li>
                <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.products.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.products.index')); ?>">
                  <span>All Products</span>
                </a>
              </li>
              <li>
                <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.products.create' ? 'active' : ''); ?>" href="<?php echo e(route('admin.products.create')); ?>">
                  <span>Create Product</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="dropdown">
            <a class="nav-link menu-title <?php echo e(request()->is('admin/home-sections*') ? 'active' : ''); ?>" href="#">
              <i data-feather="layers"> </i><span>Home Sections</span>
              <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->is('admin/home-sections*') ? 'down' : 'right'); ?>"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: <?php echo e(request()->is('admin/home-sections*') ? 'block;' : 'none;'); ?>">
              <li>
                <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.home-sections.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.home-sections.index')); ?>">
                  <span>All Sections</span>
                </a>
              </li>
              <li>
                <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.home-sections.create' ? 'active' : ''); ?>" href="<?php echo e(route('admin.home-sections.create')); ?>">
                  <span>Create Section</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="dropdown">
            <a class="nav-link menu-title <?php echo e(request()->is('admin/pages*') ? 'active' : ''); ?>" href="#">
              <i data-feather="layers"> </i><span>Pages</span>
              <div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->is('admin/pages*') ? 'down' : 'right'); ?>"></i></div>
            </a>

            <ul class="nav-submenu menu-content" style="display: <?php echo e(request()->is('admin/pages*') ? 'block;' : 'none;'); ?>">
              <li>
                <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.pages.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.pages.index')); ?>">
                  <span>All Pages</span>
                </a>
              </li>
              <li>
                <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.pages.create' ? 'active' : ''); ?>" href="<?php echo e(route('admin.pages.create')); ?>">
                  <span>Create Page</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li>
            <a class="nav-link menu-title link-nav <?php echo e(Route::currentRouteName()=='admin.menus.index' ? 'active' : ''); ?>" href="<?php echo e(route('admin.menus.index')); ?>">
              <i data-feather="menu"> </i>
              <span>Menus</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</header><?php /**PATH E:\XAMPP\htdocs\starter-kit\resources\views/layouts/light/sidebar.blade.php ENDPATH**/ ?>