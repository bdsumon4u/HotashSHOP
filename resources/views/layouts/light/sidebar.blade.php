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
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/orders*') ? 'active' : '' }}"
                            href="{{ route('admin.orders.index', ['status' => 'PENDING']) }}">
                            <i data-feather="check"> </i>
                            <span>Orders</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title {{ request()->is('admin/products*') ? 'active' : '' }}"
                            href="#">
                            <i data-feather="shopping-cart"> </i><span>Products</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{ request()->is('admin/products*') ? 'down' : 'right' }}"></i>
                            </div>
                        </a>

                        <ul class="nav-submenu menu-content"
                            style="display: {{ request()->is('admin/products*') ? 'block;' : 'none;' }}">
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}"
                                    href="{{ route('admin.products.index') }}">
                                    <span>All Products</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.products.create' ? 'active' : '' }}"
                                    href="{{ route('admin.products.create') }}">
                                    <span>Create Product</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/attributes*') ? 'active' : '' }}"
                            href="{{ route('admin.attributes.index') }}">
                            <i data-feather="check"> </i>
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

                    <li class="sidebar-title">
                        <h6>Gallery</h6>
                    </li>

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
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings') && request('tab')=='company' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'company']) }}">
                            <i data-feather="image"> </i>
                            <span>Company Info</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/slides*') ? 'active' : '' }}"
                            href="{{ route('admin.slides.index') }}">
                            <i data-feather="image"> </i>
                            <span>Slides</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title {{ request()->is('admin/home-sections*') ? 'active' : '' }}"
                            href="#">
                            <i data-feather="layers"> </i><span>Sections</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{ request()->is('admin/home-sections*') ? 'down' : 'right' }}"></i>
                            </div>
                        </a>

                        <ul class="nav-submenu menu-content"
                            style="display: {{ request()->is('admin/home-sections*') ? 'block;' : 'none;' }}">
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.home-sections.index' ? 'active' : '' }}"
                                    href="{{ route('admin.home-sections.index') }}">
                                    <span>All Sections</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.home-sections.create' ? 'active' : '' }}"
                                    href="{{ route('admin.home-sections.create') }}">
                                    <span>Create Section</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/menus*', 'admin/category-menus*') ? 'active' : '' }}"
                            href="{{ route('admin.menus.index') }}">
                            <i data-feather="menu"> </i>
                            <span>Menus</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title {{ request()->is('admin/pages*') ? 'active' : '' }}"
                            href="#">
                            <i data-feather="layers"> </i><span>Pages</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{ request()->is('admin/pages*') ? 'down' : 'right' }}"></i>
                            </div>
                        </a>

                        <ul class="nav-submenu menu-content"
                            style="display: {{ request()->is('admin/pages*') ? 'block;' : 'none;' }}">
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.pages.index' ? 'active' : '' }}"
                                    href="{{ route('admin.pages.index') }}">
                                    <span>All Pages</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.pages.create' ? 'active' : '' }}"
                                    href="{{ route('admin.pages.create') }}">
                                    <span>Create Page</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title {{ request()->is('admin/reports*') ? 'active' : '' }}"
                            href="#">
                            <i data-feather="pie-chart"> </i> </i><span>Reports</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{ request()->is('admin/reports*') ? 'down' : 'right' }}"></i>
                            </div>
                        </a>

                        <ul class="nav-submenu menu-content"
                            style="display: {{ request()->is('admin/reports*') ? 'block;' : 'none;' }}">
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.orders.filter' ? 'active' : '' }}"
                                    href="{{ route('admin.orders.filter') }}">
                                    <span>Filtering</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.reports.index' ? 'active' : '' }}"
                                    href="{{ route('admin.reports.index') }}">
                                    <span>Scanning</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="sidebar-title">
                        <h6>Reports</h6>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title {{ request()->is('admin/reports*') ? 'active' : '' }}"
                            href="#">
                            <i data-feather="pie-chart"> </i> </i><span>Orders</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{ request()->is('admin/reports*') ? 'down' : 'right' }}"></i>
                            </div>
                        </a>

                        <ul class="nav-submenu menu-content"
                            style="display: {{ request()->is('admin/reports*') ? 'block;' : 'none;' }}">
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.orders.filter' ? 'active' : '' }}"
                                    href="{{ route('admin.orders.filter') }}">
                                    <span>Filtering</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.reports.index' ? 'active' : '' }}"
                                    href="{{ route('admin.reports.index') }}">
                                    <span>Scanning</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.staffs.index' ? 'active' : '' }}"
                            href="{{ route('admin.staffs.index') }}">
                            <i data-feather="users"> </i>
                            <span>Stock</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.staffs.index' ? 'active' : '' }}"
                            href="{{ route('admin.staffs.index') }}">
                            <i data-feather="users"> </i>
                            <span>Top Products</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.staffs.index' ? 'active' : '' }}"
                            href="{{ route('admin.staffs.index') }}">
                            <i data-feather="users"> </i>
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
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.staffs.index' ? 'active' : '' }}"
                            href="{{ route('admin.staffs.index') }}">
                            <i data-feather="users"> </i>
                            <span>Customers</span>
                        </a>
                    </li>

                    <li class="sidebar-title">
                        <h6>Settings</h6>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/profile*') ? 'active' : '' }}"
                            href="{{ route('admin.password.change') }}">
                            <i data-feather="truck"> </i>
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
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='analytics' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'analytics']) }}">
                            <i data-feather="truck"> </i>
                            <span>Analytics</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}"
                            href="{{ route('admin.settings') }}">
                            <i data-feather="truck"> </i>
                            <span>SMS</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ request()->is('admin/settings*') && request('tab')=='courier' ? 'active' : '' }}"
                            href="{{ route('admin.settings', ['tab' => 'courier']) }}">
                            <i data-feather="truck"> </i>
                            <span>Couriers</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}"
                            href="{{ route('admin.settings') }}">
                            <i data-feather="truck"> </i>
                            <span>Payment Gateways</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}"
                            href="{{ route('admin.settings') }}">
                            <i data-feather="truck"> </i>
                            <span>Fraud Management</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}"
                            href="{{ route('admin.settings') }}">
                            <i data-feather="truck"> </i>
                            <span>Social Media</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}"
                            href="{{ route('admin.settings') }}">
                            <i data-feather="truck"> </i>
                            <span>Currency</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}"
                            href="{{ route('admin.settings') }}">
                            <i data-feather="truck"> </i>
                            <span>Cache Clear</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
