<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersHowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers_howers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
           $table->string('phone_number')->nullable();
           $table->string('city')->nullable();

           $table->json('hower')->nullable();

           $table->string('volunteer_from')->nullable();

           $table->longText('note')->nullable();


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
        Schema::dropIfExists('volunteers_howers');
    }
}
