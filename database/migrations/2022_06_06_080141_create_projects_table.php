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
            $table->json('pictures')->nullable();
            $table->integer('approval')->nullable();
            $table->string("reason_of_reject")->nullable();
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
        Schema::dropIfExists('projects');
    }
}
