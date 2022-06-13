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
            $table->integer('project_number');
            $table->string('project_goal');
            $table->string('projec_type');
            $table->string('Project_Status')->default("Initial");
            $table->time('projec_start');
            $table->time('projec_end');
            $table->json('city_id');
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
