<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->float('sub_total');
            $table->float('coupon')->nullable();
            $table->float('total_amount');
            $table->integer('quantity');
            $table->enum('payment_method',['cod','paypal'])->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('status',['new','process','delivered','cancel'])->default('new');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('post_code')->nullable();
            $table->text('shipping_addrs');
            $table->text('billing_addrs')->nullable();
            $table->timestamps();
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
