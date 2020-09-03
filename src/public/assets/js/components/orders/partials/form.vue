<template>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <template v-for="(value, keu) in order_statuses">
                        <label><input type="radio" name="order_status" :value="key" v-model="item.order_status"> {{ value }}</label>
                    </template>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">@lang('ordermate::main.Name')</label>
                        <input class="form-control" name="name" type="text" id="name" value="{{ isset(item.name) ? item.name : ''}}" required>
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('delivery_date') ? 'has-error' : ''}}">
                        <label for="delivery_date" class="control-label">@lang('ordermate::main.Delivery Date')</label>
                        <input type="date" class="form-control" name="delivery_date" id="delivery_date" value="{{ isset(item.delivery_date) ? item.delivery_date : ''}}">
                        {!! $errors->first('delivery_date', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
                        <label for="product_id" class="control-label">@lang('ordermate::main.Product')</label>
                        <input type="number" class="form-control" name="product_id" id="product_id" value="{{ isset(item.product_id) ? item.product_id : ''}}">
                        {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('payment_option') ? 'has-error' : ''}}">
                        <label for="payment_option" class="control-label">@lang('ordermate::main.Payment Option')</label>
                        <select name="payment_option" id="payment_option" class="form-control">
                            <option value="paypal"
                                    {{ item.payment_option == 'paypal' ? 'selected' : '' }}
                                >@lang('ordermate::main.Paypal')</option>
                            <option value="bank"
                                    {{ item.payment_option == 'bank' ? 'selected' : '' }}
                                >@lang('ordermate::main.Bank')</option>
                            <option value="cod"
                                    {{ item.payment_option == 'cod' ? 'selected' : '' }}
                                >@lang('ordermate::main.Cash on Delivery')</option>
                        </select>
                        {!! $errors->first('payment_option', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                        <label for="product_id" class="control-label">@lang('ordermate::main.Amount')</label>
                        <input type="number" class="form-control" name="amount" id="amount" value="{{ isset(item.amount) ? item.amount : ''}}">
                        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('shipping_address') ? 'has-error' : ''}}">
                        <label for="shipping_address" class="control-label">@lang('ordermate::main.Shipping Address')</label>
                        <textarea class="form-control" rows="5" name="shipping_address" type="textarea" id="shipping_address" >{{ isset(item.shipping_address) ? item.shipping_address : ''}}</textarea>
                        {!! $errors->first('shipping_address', '<p class="help-block">:message</p>') !!}
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
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">@lang('ordermate::main.First Name')</label>
                        <input class="form-control" name="first_name" type="text" id="first_name" value="{{ isset(item.customer.first_name) ? item.customer.first_name : ''}}" required>
                        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">@lang('ordermate::main.Last Name')</label>
                        <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset(item.customer.last_name) ? item.customer.last_name : ''}}" required>
                        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">@lang('ordermate::main.Phone')</label>
                        <input class="form-control" name="phone" type="text" id="phone" value="{{ isset(item.customer.phone) ? item.customer.phone : ''}}" required>
                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">@lang('ordermate::main.Email')</label>
                        <input class="form-control" name="email" type="email" id="email" value="{{ isset(item.customer.email) ? item.customer.email : ''}}" required>
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                        <label for="address" class="control-label">@lang('ordermate::main.Address')</label>
                        <textarea class="form-control" rows="5" name="address" type="textarea" id="address" >{{ isset(item.customer.address) ? item.customer.address : ''}}</textarea>
                        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    @lang('app.Publish')
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {},
        data() {
            return {}
        },
        computed: {
            item() {
                return this.$store.getters.order;
            },
            order_statuses() {
                return this.$store.getters.order_statuses;
            }
        },
    }
</script>