<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1" />
    <title>@stack('title')</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    @include('layouts.template_admin.style')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('layouts.template_admin.sidebar')
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="{{ asset('template/administrator/assets/img/kaiadmin/logo_light.svg') }}"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          @include('layouts.template_admin.navbar')
          <!-- End Navbar -->
        </div>

       @include('layouts.template_admin.content')
       {{-- @yield('content') --}}

       @include('layouts.template_admin.footer')
      </div>

      <!-- Custom template | don't include it in your project! -->
      {{-- @include('layouts.template_admin.setting') --}}
      <!-- End Custom template -->
    </div>
    @include('layouts.template_admin.script')
  </body>
</html>
