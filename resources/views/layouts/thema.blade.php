<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/logo/iconWIS.png') }}" type="image/x-icon">

    <title>{{ $title ?? "dashboard" }}</title>

    @include('layouts.partials.links')

    <style>
        .fontSmallSize {
            font-size: 12px;
        }

        .fontSmallSize2 {
            font-size: 14px;
        }

        .blink_me {
            animation: blinker 5s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0.4;
            }
        }

        div {
            font-family: 'Trebuchet MS', sans-serif;
        }
    </style>

    @stack('style')


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('sweetalert::alert')

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/logo/Infinite_Studios_kinema.png') }}" alt="Loading" width="90%">
        </div> -->

        <!-- Navbar -->
        @include('layouts.partials.navbarHeader')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('img/logo/iconWIS.png') }}" alt="logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light fontSmallSize text-uppercase blink_me">Wide Information Systems</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/logo/iconWIS.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->username }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                @include('layouts.partials.navbarLeft')
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 fontSmallSize2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.partials.footer')

        <!-- Control Sidebar -->
        @include('layouts.partials.navbarRight')
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('layouts.partials.scripts')

    @stack('scripts')
</body>

</html>