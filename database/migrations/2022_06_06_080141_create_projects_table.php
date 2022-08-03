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
            $table->char('Financial_Type',1);
            $table->integer('project_type');
            $table->char('Project_Status', 1)->default('1');
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->double('Budjet')->default(0.0);
            $table->boolean('is_has_volunteer')->default(0);
            $table->boolean('is_has_Donations')->default(0);
            $table->json('areas')->nullable();
            $table->json('cities')->nullable();
            $table->boolean('is_reported')->default(0);
            $table->char('report_status', 1)->default('1');
            $table->string('report_title')->nullable();
            $table->longText('report_contents')->nullable();
            $table->longText('report_description')->nullable();

            $table->string('report_image')->nullable();
            $table->json('report_pictures')->nullable();
            $table->string('report_video_link')->nullable();

            $table->integer('admin_id');
            $table->char('approval_Status', 1)->default('1');
            $table->integer('approval')->nullable();
            $table->string("reason_of_reject")->nullable();
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
