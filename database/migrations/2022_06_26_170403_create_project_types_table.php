<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('describtion')->nullable();
            $table->char('code', 2);
            $table->char('type', 1);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('update_by')->references('id')->on('users')
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
        Schema::dropIfExists('project_types');
    }
}
