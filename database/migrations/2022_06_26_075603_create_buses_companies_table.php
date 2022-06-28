<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('buses_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double("cost");
            $table->integer('number_of_buses');
            $table->string('contact_person');
            $table->string('phone_number');
            $table->char('status', 1)->default('1');
            $table->unsignedBigInteger('Created_By')->nullable();
            $table->unsignedBigInteger('Update_By')->nullable();

            $table->foreign('Created_By')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('Update_By')->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('buses_companies');
    }
}
