<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartorders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->string('address');
            $table->string('postcode');
            $table->string('message');
            $table->integer('discount');
            $table->float('subtotal');
            $table->float('total');
            $table->integer('payment_status')->comment('1=pending,2=paid');
            $table->integer('payment_option')->comment('1=Credit Card,2=Cash On Delivery');
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
        Schema::dropIfExists('cartorders');
    }
}
