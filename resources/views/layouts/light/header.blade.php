<div class="page-main-header">
  <div class="main-header-right row m-0">
    <form class="form-inline search-full" action="#" method="get">
      <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
            <i class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="main-header-left">
      <div class="logo-wrapper">
        <a href="{{route('/')}}">
          <img class="img-fluid" src="{{asset($logo->desktop ?? '')}}" alt="Logo">
        </a>
      </div>
      <button style="padding:2px 10px;border:none;background:none;" class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></button>
    </div>
    <div class="left-menu-header col horizontal-wrapper pl-0">

    </div>
    <div class="nav-right col-8 pull-right right-menu">
      <ul class="nav-menus">

        <li>
          <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>
        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="profile-nav onhover-dropdown p-0">
          <div class="media profile-media">
            <img class="b-r-10" src="{{asset('assets/images/dashboard/profile.jpg')}}" alt="">
            <div class="media-body">
              <span>{{ $admin->name }}</span>
              <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li><a href="{{ route('admin.settings') }}"><i data-feather="settings"></i><span>Settings</span></a></li>
            <li><a href="{{ route('admin.password.change') }}"><i data-feather="lock"></i><span>Password</span></a></li>
            <li>
              <a class="" href="{{ route('admin.logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i data-feather="log-in"> </i> {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
