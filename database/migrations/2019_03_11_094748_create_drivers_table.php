<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->binary('image')->nullable();
            $table->integer('detail_id')->unsigned();
            $table->binary('insurance')->nullable();
            $table->binary('license')->nullable();
            $table->binary('identity');
            $table->foreign('detail_id')->references('detail_id')->on('ownerCarDetails');
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
        Schema::dropIfExists('drivers');
    }
}
