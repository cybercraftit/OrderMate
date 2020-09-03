<template>
    <div>
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="mb-5">
                        <div class="pull-left">
                            <h5>Orders</h5>
                        </div>
                    </div>
                    <table class="table table-responsive" cellspacing="0">
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
                        <template v-if="typeof orders.items == 'object'">
                            <tr v-for="(item, k) in orders.items.data">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.customer.first_name }} {{ item.customer.last_name }}</td>
                                <td>{{ item.customer.phone }}</td>
                                <td>{{ item.customer.email }}</td>
                                <td>{{ item.delivery_date }}</td>
                                <td>{{ item.payment_option }}</td>
                                <td>{{ item.amount }}</td>
                                 <td>
                                     <a v-if="item.can.read" :href="'#/orders/show/' + item.id" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                     <a v-if="item.can.edit" :href="'#/orders/edit/' + item.id" class="btn btn-sm btn-success"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                     <template v-if="item.can.delete">
                                         <!--<form method="POST" action="delete_item(item.id)" accept-charset="UTF-8" style="display:inline">
                                             {{ method_field('DELETE') }}
                                             {{ csrf_field() }}
                                             <button type="submit" class="btn btn-danger btn-sm" title="{{ __( 'ordermate::main.Delete') }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                         </form>-->
                                     </template>
                                </td>
                            </tr>
                        </template>

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
        name: 'OrderIndex',
        props: {},
        data() {
            return {
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
        computed: {
            orders() {
                return this.$store.getters.orders;
            },
        },
        methods: {
            get_orders(url) {
                this.fetch_data(url);
            },
            delete_item(id) {
                this.$store.dispatch('deleteOrder', {id})
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
            }
        },
        mounted() {
            this.$store.dispatch('getOrders', {page:1})
        }
    }
</script>