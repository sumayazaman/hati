<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    

    <title>Hati - @yield('title')</title>

    <!-- vendor css -->
    <link href="{{ asset('starlight/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('starlight/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{ asset('starlight/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('starlight/css/starlight.css')}}">
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> starlight</a></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="{{ route('home') }}" class="sl-menu-link @yield('dashboard-active')">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @if (Auth::user()->role == 1)
          <a href="{{ route('category') }}" class="sl-menu-link @yield('category-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
              <span class="menu-item-label">Category</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('product') }}" class="sl-menu-link @yield('product-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
              <span class="menu-item-label">Product</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('setting') }}" class="sl-menu-link @yield('setting-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
              <span class="menu-item-label">Settings</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('banner') }}" class="sl-menu-link @yield('banner-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
              <span class="menu-item-label">Banner</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('testimonial.index') }}" class="sl-menu-link @yield('testimonial-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
              <span class="menu-item-label">Testimonial</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <a href="{{ route('coupon.index') }}" class="sl-menu-link @yield('coupon-active')">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
              <span class="menu-item-label">Coupon</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link --> 
        @endif
        
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Pages</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ route('faq') }}" class="nav-link">FAQ Page</a></li>
        </ul>
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user() -> name }}</span></span>
              <img src="{{ asset('starlight/img/img3.jpg') }}" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="icon ion-power"></i> Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->    

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        @yield('breadcrumb')
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
          @yield('content')
        </div><!-- sl-page-title -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{ asset('starlight/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('starlight/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('starlight/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('starlight/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('starlight/js/starlight.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('sweetalert')

  </body>
</html>
