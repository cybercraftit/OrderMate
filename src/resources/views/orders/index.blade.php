@extends('ordermate::main')

@section('body')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    <a href="javascript:" class="btn btn-success btn-sm" onclick="window.print()"><i class="fa fa-print"></i></a>
                </div>
            </div>
        </div>
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fa fa-table mr-1"></i>
                @lang('ordermate::main.Orders')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>@lang('ordermate::main.Name')</th>
                            <th>@lang('ordermate::main.Customer')</th>
                            <th>@lang('ordermate::main.Phone')</th>
                            <th>@lang('ordermate::main.Email')</th>
                            <th>@lang('ordermate::main.Delivery Date')</th>
                            <th>@lang('ordermate::main.Payment Option')</th>
                            <th>@lang('ordermate::main.Amount')</th>
                            <th>@lang('ordermate::main.Action')</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>@lang('ordermate::main.Name')</th>
                            <th>@lang('ordermate::main.Customer')</th>
                            <th>@lang('ordermate::main.Phone')</th>
                            <th>@lang('ordermate::main.Email')</th>
                            <th>@lang('ordermate::main.Delivery Date')</th>
                            <th>@lang('ordermate::main.Payment Option')</th>
                            <th>@lang('ordermate::main.Amount')</th>
                            <th>@lang('ordermate::main.Action')</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach( $items as $k => $item )
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->customer->first_name }} {{ $item->customer->last_name }}</td>
                                <td>{{ $item->customer->phone }}</td>
                                <td>{{ $item->customer->email }}</td>
                                <td>{{ $item->delivery_date }}</td>
                                <td>{{ $item->payment_option }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>
                                    @can('read', $item)
                                        <a href="{{ route('ordermate.orders.show', $item->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @endcan
                                        @can('edit', $item)
                                            <a href="{{ route('ordermate.orders.edit', $item->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        @endcan
                                        @can('delete', $item)
                                            <form method="POST" action="{{ route('ordermate.orders.delete', $item->id ) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="{{ __( 'ordermate::main.Delete') }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="pagination-wrapper"> {!! $items->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>
        </div>
    </div>
@stop