<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
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
            $table->string('client_id')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->integer('total_payment')->nullable();
            $table->string('status')->default('For Approval');
            $table->string('email_status')->default('Not Sent');
            $table->json('product_ids')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE orders AUTO_INCREMENT = 10000;");

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
