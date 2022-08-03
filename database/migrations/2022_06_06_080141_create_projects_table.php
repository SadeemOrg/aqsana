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


            $table->boolean('is_reported')->default(0);
            $table->string('report_title')->nullable();
            $table->longText('report_description')->nullable();
            $table->longText('report_text')->nullable();
            $table->string('report_image')->nullable();
            $table->json('pictures')->nullable();


            $table->integer('sector');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->double('Budjet')->default(0.0);
            $table->integer('admin_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();

            // $table->foreign('created_by')->references('id')->on('users')
            //     ->onDelete('cascade');
            // $table->foreign('update_by')->references('id')->on('users')
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
        Schema::dropIfExists('projects');
    }
}
