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
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id')->index('contacts_group_id_foreign');
            $table->string('name', 191);
            $table->string('email', 191);
            $table->boolean('is_sent')->default(false);
            $table->timestamps();
            $table->unsignedInteger('campaign_id')->nullable();
            $table->boolean('is_failed')->default(false);
            $table->bigInteger('job_id')->nullable();
            $table->longText('failed_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
