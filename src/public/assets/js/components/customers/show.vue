<template>
    <div>
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-sm-12 text-right">
                    <a v-if="typeof customer.can != 'undefined' && customer.can.browse" href="#/customers" class="btn btn-sm btn-warning" title="@lang('ordermate::main.List')"><i class="fa fa-list"></i></a>
                    <a v-if="typeof customer.can != 'undefined' && customer.can.edit" :href="'#/customers/edit/' + customer.id" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                    <a href="javascript:" class="btn btn-success btn-sm" onclick="window.print()"><i class="fa fa-print"></i></a>
                    <button v-if="typeof customer.can != 'undefined' && customer.can.delete" type="submit" @click="delete_item(customer)" class="btn btn-danger btn-sm" title="__( 'ordermate::main.Delete')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    <!--<a href="{{ route('ordermate.orders.show.pdf', $item->id ) }}" class="btn btn-warning btn-sm" @click="make_pdf"><i class="fa fa-print"></i></a>-->
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <h5>@lang('ordermate::main.Customer')</h5>
                    <h4><i class="fa fa-user"></i> {{ customer.first_name }} {{ customer.last_name }}</h4>
                    <div><i class="fa fa-phone"></i> {{ customer.phone }}</div>
                    <div><i class="fa fa-envelope"></i> {{ customer.email }}</div>
                    <div><i class="fa fa-address-book"></i> {{ customer.address }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        name: 'CustomerShow',
        props: {},
        data() {
            return {}
        },
        computed: {
            customer() {
                return this.$store.getters.customer;
            },
        },
        methods: {
            delete_item(customer) {
                var _this = this;
                this.$store.dispatch('deleteCustomer', {customer,callback: function(){
                    _this.$router.push('/customers');
                }})
            }
        },
        mounted() {
            this.$store.dispatch('getCustomer', {id:this.$route.params.id})
        }
    }
</script>