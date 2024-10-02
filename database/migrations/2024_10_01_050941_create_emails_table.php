<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('bio')->nullable();
            $table->string('profileUrl')->nullable();
            $table->string('profile')->nullable();
            $table->string('birthday')->nullable();
            $table->string('contactNumber')->nullable();
            $table->boolean('scraped')->default(true);
            $table->text('metaData')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
