<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->char('type', 1);
            $table->char('status', 1);
            $table->bigInteger('project_id')->nullable();
            $table->integer('transact_amount');
            $table->string('equivelant_amount');
            $table->unsignedBigInteger('Currency')->nullable();
            $table->string('Rate')->nullable();


            $table->time('projec_start');
            $table->integer('approval')->nullable();
            $table->string("reason_of_reject")->nullable();
            $table->time('transaction_date');

            $table->unsignedBigInteger('Created_By')->nullable();
            $table->unsignedBigInteger('Update_By')->nullable();

            // $table->foreign('Created_By')->references('id')->on('users')
            //     ->onDelete('cascade');
            // $table->foreign('Update_By')->references('id')->on('users')
            //     ->onDelete('cascade');
            //     $table->foreign('Currency')->references('id')->on('currencies')
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
        Schema::dropIfExists('transactions');
    }
}
