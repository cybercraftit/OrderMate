<?php

namespace CyberCraft\OrderMate\models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'address'];

    public function orders() {
        return $this->hasMany( Order::class );
    }
}
