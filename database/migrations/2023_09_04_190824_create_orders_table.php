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
            $table->id();
            $table->string("order_id");
            $table->integer("user_id");
            $table->string("address1");
            $table->string("address2")->nullable();
            $table->string("city");
            $table->string("state");
            $table->string("country");
            $table->string("pincode");
            $table->string("landmark");
            $table->string("phone");
            $table->double("total_amount");
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
