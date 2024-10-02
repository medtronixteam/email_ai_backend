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
        Schema::create('user_emails', function (Blueprint $table) {
            $table->id();
            $table->string('mail_type')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('main_mailer')->nullable();
            $table->string('main_host')->nullable();
            $table->string('main_port')->nullable();
            $table->string('main_username')->nullable();
            $table->string('main_password')->nullable();
            $table->string('main_encryption')->nullable();
            $table->string('main_from_address')->nullable();
            $table->string('main_from_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_emails');
    }
};
