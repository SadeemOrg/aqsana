<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('donername');
            $table->string('Location');
            $table->integer('identity_number');
            $table->string('iban');
            $table->string('swift_code');
            $table->double('amount');
            $table->time('transaction_date');
            $table->unsignedBigInteger('currency_id ')->nullable();
            $table->unsignedBigInteger('Created_By')->nullable();
            $table->unsignedBigInteger('Update_By')->nullable();


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
        Schema::dropIfExists('bank_transfers');
    }
}
