<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mail_type', 191)->nullable();
            $table->unsignedBigInteger('user_id')->index('user_emails_user_id_foreign');
            $table->string('main_mailer', 191)->nullable();
            $table->string('main_host', 191)->nullable();
            $table->string('main_port', 191)->nullable();
            $table->string('main_username', 191)->nullable();
            $table->string('main_password', 191)->nullable();
            $table->string('main_encryption', 191)->nullable();
            $table->string('main_from_address', 191)->nullable();
            $table->string('main_from_name', 191)->nullable();
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
        Schema::dropIfExists('user_emails');
    }
};
