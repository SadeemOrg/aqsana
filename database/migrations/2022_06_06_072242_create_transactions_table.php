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
            $table->bigInteger('ref_id')->nullable();
            $table->integer('transact_amount');
            $table->unsignedBigInteger('Currency')->nullable();
            $table->string('equivelant_amount');

            $table->unsignedBigInteger('name')->nullable();
            $table->string('description')->nullable();

            $table->char('lang', 1)->default(0);
            $table->char('Payment_type', 1)->default(0);
            $table->json('Payment_type_details')->nullable();;
            $table->string('voucher')->nullable();
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
