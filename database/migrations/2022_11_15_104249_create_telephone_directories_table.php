<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephoneDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telephone_directories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
             $table->string('email')->nullable();
            $table->char('type', 1)->nullable();
            $table->string('phone_number')->nullable();
            $table->string('city')->nullable();
            $table->string('roles')->nullable();
            $table->string('jop')->nullable();
            $table->string('id_number')->nullable();


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
        Schema::dropIfExists('telephone_directories');
    }
}
