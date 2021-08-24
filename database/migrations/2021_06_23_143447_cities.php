<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->String('region_number')->nullable();
            $table->String('province_name')->nullable();
            $table->String('city_name')->nullable();
            $table->String('province_id')->nullable();
            $table->String('region_id')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE cities AUTO_INCREMENT = 3080;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
