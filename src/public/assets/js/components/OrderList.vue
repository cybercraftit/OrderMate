<template>
    <div>
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="mb-5">
                        <div class="pull-left">
                            <h5>Orders</h5>
                        </div>
                        <a href="javascript:" @click="close_list" class="btn btn-sm btn-danger pull-right"><i class="fa fa-close"></i></a>
                    </div>
                    <table class="table table-responsive" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>@lang('ordermate::main.Name')</th>
                            <th>@lang('ordermate::main.Delivery Date')</th>
                            <th>@lang('ordermate::main.Payment Option')</th>
                            <th>@lang('ordermate::main.Amount')</th>
                            <!-- <th>@lang('ordermate::main.Action')</th> -->
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>@lang('ordermate::main.Name')</th>
                            <th>@lang('ordermate::main.Delivery Date')</th>
                            <th>@lang('ordermate::main.Payment Option')</th>
                            <th>@lang('ordermate::main.Amount')</th>
                            <!-- <th>@lang('ordermate::main.Action')</th> -->
                        </tr>
                        </tfoot>
                        <tbody>
                         <tr v-for="(item, k) in orders">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.delivery_date }}</td>
                                <td>{{ item.payment_option }}</td>
                                <td>{{ item.amount }}</td>
                                <!-- <td>
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
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item" v-if=nav_data.next_page_url><a class="page-link" :href="nav_data.next_page_url" @click="get_orders(nav_data.next_page_url)">Next</a></li>
                    </ul>
                </nav>
                <!-- <div class="pagination-wrapper"> {!! $items->appends(['search' => Request::get('search')])->render() !!} </div> -->
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        name: 'OrderList',
        props: {
            customer_id: {
                type: Number
            },
            routes: {
                type: Object
            }
        },
        data() {
            return {
                orders: {},
                nav_data: {
                    current_page: null,
                    from: null,
                    last_page: null,
                    first_page_url: null,
                    last_page_url: null,
                    next_page_url: null
                }
            }
        },
        methods: {
            get_orders(url) {
                this.fetch_data(url);
            },
            fetch_data(url) {
                let _this = this;
                axios.post(url, {
                    customer: _this.customer_id
                })
                    .then(function (res) {
                        _this.orders = res.data.items.data;
                        console.log(_this.orders);
                        _this.nav_data = {
                            current_page: res.data.items.current_page,
                            from: res.data.items.from,
                            last_page: res.data.items.last_page,
                            first_page_url: res.data.items.first_page_url,
                            last_page_url: res.data.items.last_page_url,
                            next_page_url: res.data.items.next_page_url
                        }
                    })
            },
            close_list: function() {
                this.$emit('ev_close_list');
            }
        },
        mounted() {
            this.fetch_data(this.routes.customer_orders);
        }
    }
</script>