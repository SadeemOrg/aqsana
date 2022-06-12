<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlhisalatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alhisalats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('city_id');
            $table->string('description');
            $table->double('amount_total')->default(0.0);
            $table->integer('status');
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            $table->string('information_location');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->bigInteger('recipient')->nullable();
            $table->bigInteger('giver')->nullable();
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
        Schema::dropIfExists('alhisalats');
    }
}
