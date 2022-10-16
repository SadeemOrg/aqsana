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
            $table->char('main_type', 1)->default(0);
            $table->char('type', 1)->default(0);
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('ref_id')->nullable();
            $table->bigInteger('ref_cite_id')->nullable();
            $table->integer('transact_amount');
            $table->unsignedBigInteger('Currency')->nullable();
            $table->string('equivelant_amount');
            $table->string('voucher')->nullable();
            $table->integer('approval')->nullable();
            $table->string("reason_of_reject")->nullable();
            $table->date('transaction_date');
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
