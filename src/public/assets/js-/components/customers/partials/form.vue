<template>
    <div class="row">
        <div class="col-sm-12" v-if="msg">
            <div class="alert alert-warning">
                {{ msg }}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div :class="'form-group ' + ( errors.first_name ? 'has-error' : '' )" class="col-6">
                            <label class="control-label">@lang('ordermate::main.First Name')</label>
                            <input class="form-control" name="first_name" type="text" id="first_name" v-model="item.first_name" required>
                        </div>
                        <div :class="'form-group ' + ( errors.last_name ? 'has-error' : '' )" class="col-6">
                            <label class="control-label">@lang('ordermate::main.Last Name')</label>
                            <input class="form-control" name="last_name" type="text" id="last_name" v-model="item.last_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div :class="'form-group ' + ( errors.phone ? 'has-error' : '' )" class="col-sm-6">
                            <label class="control-label">@lang('ordermate::main.Phone')</label>
                            <input class="form-control" name="phone" type="text" id="phone" v-model="item.phone" required>
                            <p class="help-block alert alert-danger" v-if="typeof errors.phone != 'undefined'">{{ errors.phone[0] }}</p>
                        </div>
                        <div :class="'form-group ' + ( errors.email ? 'has-error' : '' )" class="col-sm-6">
                            <label class="control-label">@lang('ordermate::main.Email')</label>
                            <input class="form-control" name="email" type="email" id="email" v-model="item.email" required>
                            <p class="help-block alert alert-danger" v-if="typeof errors.email != 'undefined'">{{ errors.email[0] }}</p>
                        </div>
                    </div>
                    <div :class="'form-group' + ( errors.address ? 'has-error' : '' )">
                        <label class="control-label">@lang('ordermate::main.Address')</label>
                        <textarea class="form-control" rows="5" name="shipping_address" type="textarea" id="address" v-model="item.address"></textarea>
                    </div>
                    <div :class="'form-group'">
                        <input class="btn btn-primary"
                               @click="update_item"
                               type="submit" :value="formMode === 'edit' ? 'Update' : 'Create'">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            formMode : {
                type: String
            }
        },
        data() {
            return {}
        },
        computed: {
            errors() {
                return this.$store.getters.errors;
            },
            msg() {
                return this.$store.getters.msg;
            },
            item() {
                return this.$store.getters.customer;
            }
        },
        methods: {
            update_item() {
                if(this.formMode == 'edit' ) {
                    this.$store.dispatch('updateCustomer', {customer:this.item});
                } else {
                    this.$store.dispatch('storeCustomer', {customer:this.item});
                }
            }
        }
    }
</script>