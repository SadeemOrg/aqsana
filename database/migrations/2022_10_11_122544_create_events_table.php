<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('note');
            $table->json('file')->nullable();
            $table->string('number_of_encounters');
            $table->json('new_event')->nullable();
            $table->date('start_events_date')->nullable();
            $table->date('end_events_date')->nullable();
            $table->string('Budget');
            $table->bigInteger('Contacts')->nullable();
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
        Schema::dropIfExists('events');
    }
}
