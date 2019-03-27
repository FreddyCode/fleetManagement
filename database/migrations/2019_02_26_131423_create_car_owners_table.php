<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carOwners', function (Blueprint $table) {
            $table->increments('owner_id');
            $table->string('code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->binary('image')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('bank')->nullable();
            $table->string('account_number')->nullable();
            $table->string('branch')->nullable();
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
        Schema::dropIfExists('carOwners');
    }
}
