@extends('ordermate::main')

@section('body')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-sm-12">
                @can('browse', \CyberCraft\OrderMate\models\Customer::class)
                    <a href="{{ route('ordermate.customers.index') }}" class="btn btn-sm btn-warning" title="@lang('ordermate::main.List')"><i class="fa fa-list"></i></a>
                @endcan
                    @can('edit', $item)
                        <a href="{{ route('ordermate.customers.edit', $item->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('delete', $item)
                        <form method="POST" action="{{ route('ordermate.customers.delete', $item->id ) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="{{ __( 'ordermate::main.Delete') }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    @endcan
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
                <h5>@lang('ordermate::main.Customer')</h5>
                <h4><i class="fa fa-user"></i> {{ $item->first_name }} {{ $item->last_name }}</h4>
                <div><i class="fa fa-phone"></i> {{ $item->phone }}</div>
                <div><i class="fa fa-envelope"></i> {{ $item->email }}</div>
                <div><i class="fa fa-address-book"></i> {{ $item->address }}</div>
            </div>
        </div>
    </div>
@stop