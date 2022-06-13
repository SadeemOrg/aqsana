<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('trip_goal');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->json('from_city_id')->nullable();
            $table->json('to_city_id')->nullable();
            $table->integer('buses_number');
            $table->integer('participants_number');
            $table->json('bus_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->char('status',1);
            $table->double('cost')->default(0);
            $table->integer('repetition')->default(0);




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
        Schema::dropIfExists('trips');
    }
}
