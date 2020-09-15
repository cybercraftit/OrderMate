<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>@lang('ordermate::main.Create New Order')</h5>
                    </div>
                </div>
                <a :href="'#/orders/'" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                <br />
                <br />

                <!--@if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif-->

                <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    <!--{{ method_field('PATCH') }}-->
                    <!--{{ csrf_field() }}-->
                    <!--@include ('ordermate::orders.form',['formMode' => 'edit'])-->
                </form>
                <order-form :formMode="formMode"></order-form>
            </div>
        </div>
    </div>
</template>
<script>
    import OrderForm from './partials/form.vue';
    export default {
        name: 'createOrder',
        components:{
            OrderForm
        },
        data() {
            return {
                formMode: 'create'
            }
        },
        mounted() {
            this.$store.dispatch('createOrder')
        }
    }
</script>