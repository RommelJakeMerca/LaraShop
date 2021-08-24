<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BeneficiaryInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary_info', function (Blueprint $table) {
            $table->id();
            $table->String('user_id')->nullable();
            $table->String('beneficiary_name')->nullable();
            $table->String('relationship')->nullable();
            $table->String('email')->nullable();
            $table->String('phone_number')->nullable();
            $table->String('region_chosen')->nullable();
            $table->String('province')->nullable();
            $table->String('city')->nullable();
            $table->String('selected_store')->nullable();
            $table->String('selected_branch')->nullable();
            $table->String('time_of_pickup')->nullable();
            $table->String('message')->nullable();
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
        Schema::dropIfExists('beneficiary_info');
    }
}
