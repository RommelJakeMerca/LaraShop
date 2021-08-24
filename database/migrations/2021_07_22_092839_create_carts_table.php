<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->String('user_id');
            $table->String('product_id')->nullable();
            $table->String('product_name')->nullable();
            $table->mediumText('product_image')->nullable();
            $table->String('product_quantity')->nullable();
            $table->String('product_price')->nullable();
            $table->String('product_current_price')->nullable();
            $table->String('cart_created_at')->nullable();
            $table->String('cart_status')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
