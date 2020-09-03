<template>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-sm-12 text-right">
                <a v-if="typeof order.can != 'undefined' && order.can.browse" href="#/orders" class="btn btn-sm btn-warning" title="@lang('ordermate::main.List')"><i class="fa fa-list"></i></a>
                <a v-if="typeof order.can != 'undefined' && order.can.edit" :href="'#/orders/edit/' + order.id" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                <!--<template v-if="order.can.delete">
                    <form method="POST" action="{{ route('ordermate.orders.delete', $item->id ) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="{{ __( 'ordermate::main.Delete') }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </form>
                </template>-->
                <a href="javascript:" class="btn btn-success btn-sm" onclick="window.print()"><i class="fa fa-print"></i></a>
                <!--<a href="{{ route('ordermate.orders.show.pdf', $item->id ) }}" class="btn btn-warning btn-sm" @click="make_pdf"><i class="fa fa-print"></i></a>-->
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
                <h4>@lang('ordermate::main.Order Number') # {{ order.id }}</h4>
                <div>
                    {{ order.name }}
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col">
                <h5>@lang('ordermate::main.Customer')</h5>
                <h4><i class="fa fa-user"></i> {{ order.customer.first_name }} {{ order.customer.last_name }}</h4>
                <div><i class="fa fa-envelope"></i> {{ order.customer.email }}</div>
                <div><i class="fa fa-phone"></i> {{ order.customer.phone }}</div>
            </div>
            <div class="col tex-right">
                <h5>@lang('ordermate::main.Address')</h5>
                {{ order.shipping_address ? order.shipping_address : order.customer.address }}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <tr>
                        <th>@lang('ordermate::main.Product')</th>
                        <td>{{ order.product_id }}</td>
                    </tr>
                    <tr>
                        <th>@lang('ordermate::main.Price')</th>
                        <td>{{ order.amount }}</td>
                    </tr>
                    <tr>
                        <th>@lang('ordermate::main.Payment Option')</th>
                        <td>{{ order.payment_option }}</td>
                    </tr>
                    <tr>
                        <th>@lang('ordermate::main.Order Status')</th>
                        <td>{{ order.order_status }}</td>
                    </tr>
                    <tr>
                        <th>@lang('ordermate::main.Delivery Date')</th>
                        <td>{{ order.delivery_date }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        name: 'OrderShow',
        props: {},
        data() {
            return {}
        },
        computed: {
            order() {
                return this.$store.getters.order;
            },
        },
        methods: {
        },
        mounted() {
            this.$store.dispatch('getOrder', {id:this.$route.params.id})
        }
    }
</script>