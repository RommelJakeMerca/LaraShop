<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSubcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory_name')->nullable();
            $table->string('category_name')->nullable();
            $table->string('category_id')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE product_subcategories AUTO_INCREMENT = 2020;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_subcategories');
    }
}
