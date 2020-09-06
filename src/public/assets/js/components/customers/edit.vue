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
                <div class="mt-4">
                    <customer-form :formMode="formMode"></customer-form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import CustomerForm from './partials/form.vue';
    export default {
        name: 'editCustomer',
        components:{
            CustomerForm
        },
        data() {
            return {
                formMode: 'edit'
            }
        },
        mounted() {
            this.$store.dispatch('editCustomer', {id:this.$route.params.id})
        }
    }
</script>