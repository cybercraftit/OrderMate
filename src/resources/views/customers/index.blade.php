@extends('ordermate::main')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <i class="fa fa-table mr-1"></i>
                        @lang('ordermate::main.Customers')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>@lang('ordermate::main.Customer')</th>
                                    <th>@lang('ordermate::main.Phone')</th>
                                    <th>@lang('ordermate::main.Email')</th>
                                    <th>@lang('ordermate::main.Address')</th>
                                    <th>@lang('ordermate::main.Action')</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>@lang('ordermate::main.Customer')</th>
                                    <th>@lang('ordermate::main.Phone')</th>
                                    <th>@lang('ordermate::main.Email')</th>
                                    <th>@lang('ordermate::main.Address')</th>
                                    <th>@lang('ordermate::main.Action')</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach( $items as $k => $item )
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            @can('read', $item)
                                                <a href="{{ route('ordermate.customers.show', $item->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            @endcan
                                            @can('edit', $item)
                                                <a href="{{ route('ordermate.customers.edit', $item->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            @endcan
                                            @can('delete', $item)
                                                <form method="POST" action="{{ route('ordermate.customers.delete', $item->id ) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="{{ __( 'ordermate::main.Delete') }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </form>
                                            @endcan
                                            <a href="javascript:" class="btn btn-sm btn-success" @click="sel_customer_id = {{ $item->id }}" title="@lang('ordermate::main.View Orders')"><i class="fa fa-list" aria-hidden="true"></i></a>
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
            <div class="col" v-if="sel_customer_id">
                <order-list :customer_id="sel_customer_id" :routes='{
                    customer_orders : "{{ route('ordermate.ajax.customer.orders') }}"
                }'
                @ev_close_list="close_list"
                ></order-list>
            </div>
        </div>
    </div>
@stop
@section('ordermate_data')
    <script>
        ordermate.data = Object.assign(ordermate.data,{
            sel_customer_id: null
        });
        ordermate.methods = Object.assign(ordermate.methods,{
            close_list: function() {
                this.sel_customer_id = null;
            }
        });
    </script>
@stop