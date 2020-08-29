<div class="row mb-5">
    <div class="col">
        <h4>@lang('ordermate::main.Order Number') # {{ $item->id }}</h4>
        <div>
            {{ $item->name }}
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col">
        <h5>@lang('ordermate::main.Customer')</h5>
        <h4><i class="fa fa-user"></i> {{ $item->customer->first_name }} {{ $item->customer->last_name }}</h4>
        <div><i class="fa fa-envelope"></i> {{ $item->customer->email }}</div>
        <div><i class="fa fa-phone"></i> {{ $item->customer->phone }}</div>
    </div>
    <div class="col tex-right">
        <h5>@lang('ordermate::main.Address')</h5>
        {{ $item->shipping_address ? $item->shipping_address : $item->customer->address }}
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table">
            <tr>
                <th>@lang('ordermate::main.Product')</th>
                <td>{{ $item->product_id }}</td>
            </tr>
            <tr>
                <th>@lang('ordermate::main.Price')</th>
                <td>{{ $item->amount }}</td>
            </tr>
            <tr>
                <th>@lang('ordermate::main.Payment Option')</th>
                <td>{{ $item->payment_option }}</td>
            </tr>
            <tr>
                <th>@lang('ordermate::main.Order Status')</th>
                <td>{{ $item->order_status }}</td>
            </tr>
            <tr>
                <th>@lang('ordermate::main.Delivery Date')</th>
                <td>{{ $item->delivery_date }}</td>
            </tr>
        </table>
    </div>
</div>