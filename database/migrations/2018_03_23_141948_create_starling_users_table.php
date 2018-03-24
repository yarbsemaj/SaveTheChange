<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarlingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starling_users', function (Blueprint $table) {
            $table->increments('id');
            $table->longText("access_token");
            $table->longText("refresh_token");
            $table->longText("customer_uid");
            $table->longText("expires_at");
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
        Schema::dropIfExists('starling_users');
    }
}
