<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->char('status',1)->default('1');
            $table->char('main_type',1)->default('0');
            $table->char('type',1)->default('1');
            $table->string('title');
            $table->longText('contents');
            $table->longText('description');
            $table->string('image');
            $table->json('pictures')->nullable();

            $table->unsignedBigInteger('Created_By')->nullable();
            $table->unsignedBigInteger('Update_By')->nullable();

            // $table->foreign('Created_By')->references('id')->on('users')
            //     ->onDelete('cascade');
            // $table->foreign('Update_By')->references('id')->on('users')
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
        Schema::dropIfExists('news');
    }
}
