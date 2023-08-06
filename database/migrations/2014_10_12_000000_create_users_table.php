<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_number');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fcm_token')->nullable();
            $table->string('user_role');
            $table->json('role')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('city')->nullable();
            $table->string('job')->nullable();
            $table->bigInteger('social_media_id')->nullable();
            $table->date('start_work_date')->nullable();
            $table->char('martial_status', 1)->nullable();
            $table->string('user_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('account_number')->nullable();







            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
