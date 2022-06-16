<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('project_describe');
            $table->json('city_id');
            $table->char('Project_Status',1)->default("1");
            $table->date('projec_day');
            $table->time('projec_start');
            $table->time('projec_end');
            $table->json('map');
            $table->integer('admin_id');
            $table->integer('approval')->nullable();
            $table->string("reason_of_reject")->nullable();
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
        Schema::dropIfExists('projects');
    }
}
