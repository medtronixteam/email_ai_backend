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
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 191)->nullable();
            $table->string('name', 191)->nullable();
            $table->text('bio')->nullable();
            $table->text('profile')->nullable();
            $table->text('profileUrl')->nullable();
            $table->string('birthday', 191)->nullable();
            $table->string('contactNumber', 191)->nullable();
            $table->boolean('scraped')->default(true);
            $table->text('metaData')->nullable();
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
        Schema::dropIfExists('emails');
    }
};
