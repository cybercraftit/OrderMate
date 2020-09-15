@extends('coremate::main')

@section('admin_side_nav')
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
@stop
@section('coremate_script_top')
    <script src="{{ asset('vendor/cybercraft/ordermate/js/ordermate.js') }}"></script>
@stop