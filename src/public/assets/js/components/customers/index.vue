<template>
    <div>
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
                                    <template v-if="typeof customers.items == 'object'">
                                        <tr v-for="(item, k) in customers.items.data">
                                            <td>{{ item.id }}</td>
                                            <td>{{ item.first_name }} {{ item.last_name }}</td>
                                            <td>{{ item.phone }}</td>
                                            <td>{{ item.email }}</td>
                                            <td>{{ item.address }}</td>
                                            <td>
                                                <a v-if="item.can.read" :href="'#/customers/show/' + item.id" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a v-if="item.can.edit" :href="'#/customers/edit/' + item.id" class="btn btn-sm btn-success"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
                                    <li class="page-item"  v-for="(n,index) in customers.items.last_page">
                                        <a class="page-link" :href="'#/customers/' + n" :class="{'active btn-primary' : customers.items.current_page == n }">{{ n }}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--<div class="col" v-if="sel_customer_id">-->
                    <!--<order-list :customer_id="sel_customer_id" :routes='{-->
                    <!--customer_items : "{{ route('ordermate.ajax.customer.items') }}"-->
                    <!--}'-->
                    <!--@ev_close_list="close_list"-->
                    <!--&gt;</order-list>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        name: 'CustomerIndex',
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
            customers() {
                return this.$store.getters.customers;
            },
        },
        methods: {
            get_customers() {
                this.fetch_data();
            },
            delete_item(customer) {
                this.$store.dispatch('deleteCustomer', {customer})
            },
            fetch_data() {
                this.$store.dispatch('getCustomers', {page:this.$route.params.page})
            }
        },
        mounted() {
            this.fetch_data();
        }
    }
</script>