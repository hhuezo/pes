<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('template/vendor/select2/css/select2.min.css') }}">

    <!-- Datatable -->
    <link href="{{ asset('template/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">

    <style>
        .nav-header {
            background-color: #EEEEEE;
        }

        .quixnav .metismenu {
            background-color: #EEEEEE;
        }

        .quixnav {
            background-color: #EEEEEE;
        }

        .quixnav .metismenu>li>a {
            color: #8598AD;
            font-size: 15.8939px;
        }

        .quixnav .metismenu>li:hover>a,
        .quixnav .metismenu>li:focus>a,
        .quixnav .metismenu>li.mm-active>a {
            background-color: #097FF5;
            color: #fff;
        }

        .progress-bar {
            background-color: #3b6fdb;

        }

        .progress {
            background-color: #6C757D;
        }

        .stat-widget-two .progress {
            height: 23px;

        }

        .create_account {
            font-family: 'Roboto', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 20px;
            line-height: 61px;

            color: #2556A2;
            text-align: center;
            margin-top: 120px;
        }

        .pes {
            font-family: 'Roboto', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 80px;
            font-weight: bold;
            line-height: 61px;

            color: #fff;
            text-align: center;
        }

        .with_progress{
            width: 41%
        }
    </style>

<style>
    .header {
        display: none;
    }

    .nav-header1{
        display: none;
    }
</style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
               <!--<  <img class="logo-abbr" src="{{ asset('template/images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('template/images/logo.svg') }}" alt="">
                <img class="brand-title" src="{{ asset('template/images/logo.svg') }}" alt="">
               img class="logo-compact" src="{{ asset('template/images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('template/images/logo-text.png') }}" alt="">-->
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">

                                    @if (config('locale.status') && count(config('locale.languages')) > 1)
                                        @foreach (array_keys(config('locale.languages')) as $lang)
                                            @if ($lang != App::getLocale())
                                                <a href="{!! route('lang.swap', $lang) !!}">
                                                    @if ($lang == 'es')
                                                        <img src="{{ asset('img/español.png') }}" style="width: 25px;">
                                                    @else
                                                        <img src="{{ asset('img/ingles.png') }}" style="width: 25px;">
                                                    @endif
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif

                                </a>
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                        unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                                        class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">

                    <div class="create_account
                    ">
                        CREATE ACCOUNT
                    </div>



                    <div class="pes
                    ">
                        PES
                    </div>


                    <div style="margin-top: 120px">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <div class="stat-text">Your progress </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar with_progress" role="progressbar"  aria-valuenow="41"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                @yield('contenido')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('template/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('template/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('template/js/custom.min.js') }}"></script>
    <script src="{{ asset('template/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins-init/select2-init.js') }}"></script>



    <!-- Datatable -->
    <script src="{{ asset('template/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins-init/datatables.init.js') }}"></script>


    <!-- mascara de entrada -->
    <script src="{{ asset('template/vendor/input-mask/jquery.inputmask.js') }}"></script>


    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Dui
            $('[data-mask]').inputmask()
        });
    </script>
</body>

</html>
