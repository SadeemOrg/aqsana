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
            $table->string('purpose');
            $table->string('report_title')->nullable();
            $table->longText('report_description');
            $table->longText('report_text')->nullable();
            $table->string('report_image')->nullable();
            $table->json('pictures')->nullable();
            $table->char('Financial_Type',1);
            $table->integer('type');
            $table->char('status',1)->default('1');
            $table->boolean('is_reported');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->double('Budjet')->default(0.0);
            $table->integer('admin_id');
            $table->integer('approval')->nullable();
            $table->string("reason_of_reject")->nullable();
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
        Schema::dropIfExists('projects');
    }
}
