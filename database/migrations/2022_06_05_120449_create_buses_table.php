<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name_driver');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('city_id');
            $table->string('bus_number');
            $table->integer('number_of_seats');
            $table->double('seat_price');
            $table->json('travel_from')->nullable();
            $table->json('travel_to')->nullable();
            $table->json('current_location')->nullable();
            $table->string('phone_number_driver');
            $table->char('status', '1');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
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
        Schema::dropIfExists('buses');
    }
}
