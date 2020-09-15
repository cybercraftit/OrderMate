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
                         <tr v-for="(item, k) in orders.items.data">
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
                <!--<nav aria-label="Page navigation example">-->
                    <!--<ul class="pagination">-->
                        <!--<li class="page-item" v-if=orders.items.next_page_url><a class="page-link" :href="orders.items.next_page_url" @click="get_orders(orders.items.next_page_url)">Next</a></li>-->
                    <!--</ul>-->
                <!--</nav>-->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"  v-for="(n,index) in orders.items.last_page">
                            <a @click="get_orders(n)" class="page-link" href="javascript:" :class="{'active btn-primary' : orders.items.current_page == n }">{{ n }}</a>
                        </li>
                    </ul>
                </nav>
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
            }
        },
        data() {
            return {}
        },
        computed: {
            orders() {
                return this.$store.getters.orders;
            }
        },
        watch: {
            'customer_id': function (id) {
                this.fetch_data(1);
            }
        },
        methods: {
            get_orders(page) {
                this.fetch_data(page);
            },
            fetch_data(page) {
                let _this = this;
                this.$store.dispatch('getCustomerOrders', {customer_id : _this.customer_id, page : page});
            },
            close_list: function() {
                this.$emit('ev_close_list');
            }
        },
        mounted() {
            this.fetch_data(1);
        }
    }
</script>