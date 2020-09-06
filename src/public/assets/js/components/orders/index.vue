<template>
    <div>
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <div class="mb-5">
                    <div class="pull-left">
                        <h5>Orders</h5>
                    </div>
                </div>
                <div class="table-responsive">
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
                                     <button v-if="item.can.delete" type="submit" @click="delete_item(item)" class="btn btn-danger btn-sm" title="__( 'ordermate::main.Delete')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
                        <li class="page-item"  v-for="(n,index) in orders.items.last_page">
                            <a class="page-link" :href="'#/orders/' + n" :class="{'active btn-primary' : orders.items.current_page == n }">{{ n }}</a>
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
        watch: {
            '$route.params.page': function (id) {
                this.fetch_data();
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
            delete_item(order) {
                this.$store.dispatch('deleteOrder', {order})
            },
            fetch_data() {
                this.$store.dispatch('getOrders', {page:this.$route.params.page})
            }
        },
        mounted() {
            this.fetch_data();
        }
    }
</script>