<header class="main-nav">
    <div class="logo-wrapper">
        <a href="{{ route('/') }}">
            <span class="h4 m-0">{{ $company->name }}</span>
        </a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="{{ route('/') }}">
            <img class="img-fluid" src="{{ asset($logo->favicon ?? '') }}" width="36" height="36" alt="">
        </a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <a href="{{ route('/') }}">
                            <img class="img-fluid" src="{{ asset($logo->favicon ?? '') }}" height="36" width="36"
                                alt="">
                        </a>
                        <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.home' ? 'active' : '' }}"
                            href="{{ route('admin.home') }}">
                            <i data-feather="home"> </i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-title">
                        <h6>Ecommerce</h6>
                    </li>

                    <li>
                        <a class="nav-link d-flex menu-title link-nav {{ request()->is('admin/orders*') ? 'active' : '' }}"
                            href="{{ route('admin.orders.index', ['status' => 'PENDING']) }}">
                            <i class="d-block" data-feather="shopping-bag"> </i>
                            <span class="d-block">Orders</span>
                            @php
                                $pendingCount = \App\Order::where('status', 'PENDING')->when(auth('admin')->user()->role_id == \App\Admin::SALESMAN, function ($query) {
                                    $query->where('admin_id', auth('admin')->id());
                                })->count();
                            @endphp
                            <span class="d-flex text-white badge badge-primary pending-count ml-auto align-items-center">{{ $pendingCount }}</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/products*') ? 'active' : '' }}"
                            href="{{ route('admin.products.index') }}">
                            <i data-feather="hash"> </i>
                            <span>Products</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/attributes*') ? 'active' : '' }}"
                            href="{{ route('admin.attributes.index') }}">
                            <i data-feather="box"> </i>
                            <span>Attributes</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/categories*') ? 'active' : '' }}"
                            href="{{ route('admin.categories.index') }}">
                            <i data-feather="server"> </i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.brands.index' ? 'active' : '' }}"
                            href="{{ route('admin.brands.index') }}">
                            <i data-feather="wind"> </i>
                            <span>Brands</span>
                        </a>
                    </li>

                    {{-- <li class="sidebar-title">
                        <h6>Gallery</h6>
                    </li> --}}

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.images.index' ? 'active' : '' }}"
                            href="{{ route('admin.images.index') }}">
                            <i data-feather="image"> </i>
                            <span>Images</span>
                        </a>
                    </li>

                    <li class="sidebar-title">
                        <h6>Appearance</h6>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='color' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'color']) }}">
                            <i data-feather="droplet"> </i>
                            <span>Color</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/slides*') ? 'active' : '' }}"
                            href="{{ route('admin.slides.index') }}">
                            <i data-feather="sliders"> </i>
                            <span>Slider</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/home-sections*') ? 'active' : '' }}"
                            href="{{ route('admin.home-sections.index') }}">
                            <i data-feather="layers"> </i>
                            <span>Sections</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/menus*', 'admin/category-menus*') ? 'active' : '' }}"
                            href="{{ route('admin.menus.index') }}">
                            <i data-feather="menu"> </i>
                            <span>Menus</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/pages*') ? 'active' : '' }}"
                            href="{{ route('admin.pages.index') }}">
                            <i data-feather="layout"> </i>
                            <span>Pages</span>
                        </a>
                    </li>

                    <li class="sidebar-title">
                        <h6>Reports</h6>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/reports', 'admin/reports/*/edit') ? 'active' : '' }}"
                            href="{{ route('admin.reports.index') }}">
                            <i data-feather="pie-chart"> </i>
                            <span>Scans</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.reports.stock' ? 'active' : '' }}"
                            href="{{ route('admin.reports.stock') }}">
                            <i data-feather="pie-chart"> </i>
                            <span>Stock</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.orders.filter' ? 'active' : '' }}"
                            href="{{ route('admin.orders.filter') }}">
                            <i data-feather="pie-chart"> </i>
                            <span>Top Products</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ false ? 'active' : '' }}"
                            href="#">
                            <i data-feather="pie-chart"> </i>
                            <span>Top Customers</span>
                        </a>
                    </li>

                    <li class="sidebar-title">
                        <h6>Users</h6>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/staffs') && request('role_id') == \App\Admin::ADMIN ? 'active' : '' }}"
                            href="{{ route('admin.staffs.index', ['role_id' => \App\Admin::ADMIN]) }}">
                            <i data-feather="users"> </i>
                            <span>Admin</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/staffs') && request('role_id') == \App\Admin::MANAGER ? 'active' : '' }}"
                            href="{{ route('admin.staffs.index', ['role_id' => \App\Admin::MANAGER]) }}">
                            <i data-feather="users"> </i>
                            <span>Manager</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/staffs') && request('role_id') == \App\Admin::SALESMAN ? 'active' : '' }}"
                            href="{{ route('admin.staffs.index', ['role_id' => \App\Admin::SALESMAN]) }}">
                            <i data-feather="users"> </i>
                            <span>Salesman</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ false ? 'active' : '' }}"
                            href="#">
                            <i data-feather="users"> </i>
                            <span>Customers</span>
                        </a>
                    </li>

                    <li class="sidebar-title">
                        <h6>Settings</h6>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings') && request('tab')=='company' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'company']) }}">
                            <i data-feather="info"> </i>
                            <span>Company</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/profile*') ? 'active' : '' }}"
                            href="{{ route('admin.password.change') }}">
                            <i data-feather="user"> </i>
                            <span>My Profile</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='delivery' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'delivery']) }}">
                            <i data-feather="truck"> </i>
                            <span>Delivery Charges</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='courier' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'courier']) }}">
                            <i data-feather="gift"> </i>
                            <span>Courier APIs</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='payment' ? 'active' : '' }}"
                            href="#">
                            <i data-feather="credit-card"> </i>
                            <span>Payment APIs</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='sms' ? 'active' : '' }}"
                            href="#">
                            <i data-feather="message-square"> </i>
                            <span>SMS APIs</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='analytics' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'analytics']) }}">
                            <i data-feather="bar-chart-2"> </i>
                            <span>Analytics</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='fraud' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'fraud']) }}">
                            <i data-feather="alert-triangle"> </i>
                            <span>Fraud Management</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='social' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'social']) }}">
                            <i data-feather="globe"> </i>
                            <span>Social Media</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='currency' ? 'active' : '' }}"
                            href="#">
                            <i data-feather="dollar-sign"> </i>
                            <span>Currency</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='others' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'others']) }}">
                            <i data-feather="more-horizontal"> </i>
                            <span>Others</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav"
                            href="{{ route('clear.cache') }}">
                            <i data-feather="refresh-cw"> </i>
                            <span>Cache Clear</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
