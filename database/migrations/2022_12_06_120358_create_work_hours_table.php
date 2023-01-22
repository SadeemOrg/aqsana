<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_hours', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('day');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->char('on_work',1)->nullable();
            $table->time('day_hours')->nullable();
            $table->time('fake_time')->nullable();
            $table->json('departure')->nullable();
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
        Schema::dropIfExists('work_hours');
    }
}
