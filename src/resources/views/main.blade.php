<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/cybercraft/ordermate/css/styles.css') }}">
    @yield('css')
</head>
<body class="sb-nav-fixed">
<div id="ordermate" v-cloak>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="/">{{ 'OrderMate' }}</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fa fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('ordermate.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-tachometer-alt"></i></div>
                            @lang('ordermate::main.Dashboard')
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="javascript:"
                           @click="select_tab('orders')">
                            <div class="sb-nav-link-icon"><i class="fa fa-columns"></i></div>
                            @lang('ordermate::main.Orders')
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <div :class="{collapse : selected_tab != 'orders'}">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#/orders">@lang('ordermate::main.Orders')</a>
                                <a class="nav-link" href="#/orders/create">@lang('ordermate::main.Add Order')</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="javascript:"
                           @click="select_tab('customers')"
                        >
                            <div class="sb-nav-link-icon"><i class="fa fa-book-open"></i></div>
                            @lang('ordermate::main.Customers')
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <div :class="{collapse : selected_tab != 'customers'}">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#/customers"> @lang('ordermate::main.Customers')</a>
                                <a class="nav-link" href="#/customers/create">@lang('ordermate::main.Add Customer')</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @include('ordermate::flash-message')
                <router-view></router-view>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<script>
    var ordermate = {
        components: {
        },
        data: {
            test: 'This is test',
            //main
            close_flash: false,
            selected_tab: null,
        },
        methods: {
            select_tab(tab) {
                if( this.selected_tab ) this.selected_tab = null;
                else this.selected_tab = tab;
            }
        }
    }
</script>
@yield('ordermate_data')
<script src="{{ asset('vendor/cybercraft/ordermate/js/ordermate-data.js') }}"></script>
<script src="{{ asset('vendor/cybercraft/ordermate/js/ordermate.js') }}"></script>
@yield('script')
</body>
</html>