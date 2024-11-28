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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->string('role', 15)->default('user');
            $table->rememberToken();
            $table->timestamps();
            $table->string('profile_photo', 191)->default('assets/images/user/avatar-1.jpg');
            $table->boolean('status')->default(true);
            $table->text('google_access_token')->nullable();
            $table->string('google_url', 191)->nullable();
            $table->string('timezone', 191)->default('UTC');
            $table->string('user_plan', 25)->default('free');
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
};
