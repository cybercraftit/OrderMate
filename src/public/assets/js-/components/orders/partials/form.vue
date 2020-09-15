<template>
    <div class="row">
        <div class="col-sm-12" v-if="msg">
            <div class="alert alert-warning">
                {{ msg }}
            </div>
        </div>
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <template v-for="(value, key) in order_statuses">
                        <label><input type="radio" name="order_status" :value="key" v-model="item.order_status"> {{ value }}</label>
                    </template>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div :class="'form-group ' + ( errors.name ? 'has-error' : '' )">
                        <label for="name" class="control-label">@lang('ordermate::main.Name')</label>
                        <input class="form-control" name="name" type="text" id="name" v-model="item.name" required>
                    </div>
                    <div :class="'form-group' + ( errors.delivery_date ? 'has-error' : '' )">
                        <label for="delivery_date" class="control-label">@lang('ordermate::main.Delivery Date')</label>
                        <input type="date" class="form-control" name="delivery_date" id="delivery_date" v-model="item.delivery_date">
                    </div>
                    <div :class="'form-group' + ( errors.product_id ? 'has-error' : '' )">
                        <label for="product_id" class="control-label">@lang('ordermate::main.Product')</label>
                        <input type="number" class="form-control" name="product_id" id="product_id" v-model="item.product_id">
                    </div>
                    <div :class="'form-group' + ( errors.payment_option ? 'has-error' : '' )">
                        <label for="payment_option" class="control-label">@lang('ordermate::main.Payment Option')</label>
                        <select name="payment_option" id="payment_option" class="form-control" v-model="item.payment_option">
                            <option value="paypal"
                                >@lang('ordermate::main.Paypal')</option>
                            <option value="bank"
                                >@lang('ordermate::main.Bank')</option>
                            <option value="cod"
                                >@lang('ordermate::main.Cash on Delivery')</option>
                        </select>
                    </div>
                    <div :class="'form-group' + ( errors.amount ? 'has-error' : '' )">
                        <label for="product_id" class="control-label">@lang('ordermate::main.Amount')</label>
                        <input type="number" class="form-control" name="amount" id="amount" v-model="item.amount">
                    </div>
                    <div :class="'form-group' + ( errors.shipping_address ? 'has-error' : '' )">
                        <label for="shipping_address" class="control-label">@lang('ordermate::main.Shipping Address')</label>
                        <textarea class="form-control" rows="5" name="shipping_address" type="textarea" id="shipping_address" v-model="item.shipping_address"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mb-4">
                <div class="card-header">
                    @lang('app.Customer Details')
                </div>
                <div class="card-body">
                    <div :class="'form-group ' + ( errors.first_name ? 'has-error' : '' )">
                        <label for="name" class="control-label">@lang('ordermate::main.First Name')</label>
                        <input class="form-control" name="first_name" type="text" id="first_name" v-model="item.customer.first_name" required>
                    </div>
                    <div :class="'form-group ' + ( errors.last_name ? 'has-error' : '' )">
                        <label for="name" class="control-label">@lang('ordermate::main.Last Name')</label>
                        <input class="form-control" name="last_name" type="text" id="last_name" v-model="item.customer.last_name" required>
                    </div>
                    <div :class="'form-group ' + ( errors.phone ? 'has-error' : '' )">
                        <label for="name" class="control-label">@lang('ordermate::main.Phone')</label>
                        <input class="form-control" name="phone" type="text" id="phone" v-model="item.customer.phone" required>
                        <p class="help-block alert alert-warning" v-if="typeof errors.phone != 'undefined'">{{ errors.phone[0] }}</p>
                    </div>
                    <div :class="'form-group ' + ( errors.email ? 'has-error' : '' )">
                        <label for="name" class="control-label">@lang('ordermate::main.Email')</label>
                        <input class="form-control" name="email" type="email" id="email" v-model="item.customer.email" required>
                    </div>
                    <div :class="'form-group ' + ( errors.address ? 'has-error' : '' )">
                        <label for="address" class="control-label">@lang('ordermate::main.Address')</label>
                        <textarea class="form-control" rows="5" name="address" type="textarea" id="address" v-model="item.customer.address"></textarea>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    @lang('app.Publish')
                </div>
                <div class="card-body">
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
                return this.$store.getters.order;
            },
            order_statuses() {
                return this.$store.getters.order_statuses;
            }
        },
        methods: {
            update_item() {
                if(this.formMode == 'edit' ) {
                    this.$store.dispatch('updateOrder', {order:this.item});
                } else {
                    this.$store.dispatch('storeOrder', {order:this.item});
                }
            }
        }
    }
</script>