<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQawafilAlaqsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qawafil_alaqsas', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('project_describe');

            $table->boolean('is_bus')->default(0);
            $table->boolean('is_volunteer')->default(0);
            $table->boolean('is_donation')->default(0);

            $table->boolean('is_reported')->default(0);
            $table->char('report_status', 1)->default('1');
            $table->string('report_title')->nullable();
            $table->longText('report_contents')->nullable();
            $table->longText('report_description')->nullable();
            $table->string('report_image')->nullable();
            $table->json('report_pictures')->nullable();
            $table->string('report_video_link')->nullable();
            $table->date('report_date');
            $table->string('sector');
            $table->datetime('start_date');
            $table->datetime('end_date');
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
        Schema::dropIfExists('qawafil_alaqsas');
    }
}
