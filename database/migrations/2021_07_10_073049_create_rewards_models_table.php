<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards_models', function (Blueprint $table) {
            $table->id();
            $table->String('user_id');
            $table->String('title');
            $table->String('reward_points');
            $table->String('expiration_points')->nullable();
            $table->String('update_time');
            $table->String('expiration_date')->nullable();
            $table->String('countdown_timer')->nullable();
            $table->String('spin_button')->nullable();
            $table->String('spin_color')->nullable();
            $table->timestamps();
            $table->String('original_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards_models');
    }
}
