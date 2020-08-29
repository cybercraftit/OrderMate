@extends('ordermate::main')

@section('body')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-sm-12 text-right">
                @can('browse', \CyberCraft\OrderMate\models\Order::class)
                    <a href="{{ route('ordermate.orders.index') }}" class="btn btn-sm btn-warning" title="@lang('ordermate::main.List')"><i class="fa fa-list"></i></a>
                @endcan
                    @can('edit', $item)
                        <a href="{{ route('ordermate.orders.edit', $item->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('delete', $item)
                        <form method="POST" action="{{ route('ordermate.orders.delete', $item->id ) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="{{ __( 'ordermate::main.Delete') }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    @endcan
                    <a href="javascript:" class="btn btn-success btn-sm" onclick="window.print()"><i class="fa fa-print"></i></a>
                    <a href="{{ route('ordermate.orders.show.pdf', $item->id ) }}" class="btn btn-warning btn-sm" @click="make_pdf"><i class="fa fa-print"></i></a>
            </div>
        </div>
        @include('ordermate::orders.partials.details')
    </div>
@stop