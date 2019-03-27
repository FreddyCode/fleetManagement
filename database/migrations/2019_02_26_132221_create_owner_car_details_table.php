<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnerCarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ownerCarDetails', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->integer('owner_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->String('car_number')->nullable();
            $table->String('car_color')->nullable();
            $table->binary('car_image')->nullable();
            $table->date('start_date');
            $table->foreign('owner_id')->references('owner_id')->on('carOwners');
            $table->foreign('model_id')->references('model_id')->on('models');
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
        Schema::dropIfExists('ownerCarDetails');
    }
}
