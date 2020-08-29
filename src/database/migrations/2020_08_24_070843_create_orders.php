<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->text('shipping_address')->nullable();
            $table->date('delivery_date')->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->string('payment_option')->nullable();
            $table->integer('amount')->nullable();
            $table->string('order_status')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
