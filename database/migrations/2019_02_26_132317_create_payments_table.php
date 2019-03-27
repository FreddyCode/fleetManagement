<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->string('month');
            $table->string('year');
            $table->date('payment_date');
            $table->decimal('amount',8,2);
            $table->string('description')->nullable();
            $table->integer('owner_id')->unsigned();
            $table->decimal('reg_amount',8,2)->default(0.00);
            $table->decimal('fuel_amount',8,2)->default(0.00);
            $table->decimal('repairs_amount',8,2)->default(0.00);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('owner_id')->references('owner_id')->on('carOwners');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
