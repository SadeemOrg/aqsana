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
            $table->string('name');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('project_id');
            $table->string('bus_number');
            $table->integer('number_person_on_bus');
            $table->json('travel_from')->nullable();
            $table->json('travel_to')->nullable();
            $table->json('current_location')->nullable();
            $table->string('driver');
            $table->string('phone_number');
            $table->char('status', 1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();

            // $table->foreign('created_by')->references('id')->on('users')
            //     ->onDelete('cascade');
            // $table->foreign('update_by')->references('id')->on('users')
            //     ->onDelete('cascade');
            // $table->foreign('company_id')->references('id')->on('buses_company')
            //     ->onDelete('cascade');
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
