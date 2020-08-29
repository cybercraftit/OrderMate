<?php

namespace CyberCraft\OrderMate\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'customer_id', 'shipping_address', 'delivery_date', 'product_id', 'payment_option', 'amount', 'order_status' ];

    public function customer() {
        return $this->belongsTo( Customer::class );
    }
}
