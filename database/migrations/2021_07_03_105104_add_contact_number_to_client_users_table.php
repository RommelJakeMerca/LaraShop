<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactNumberToClientUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_users', function (Blueprint $table) {
            $table->string('gender')->after('email')->nullable();
            $table->string('address')->after('gender')->nullable();
            $table->string('contact_number')->after('address')->nullable();
            $table->string('time_in')->after('contact_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_users', function (Blueprint $table) {
            //
        });
    }
}
