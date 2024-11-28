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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->unsignedBigInteger('group_id')->index('campaigns_group_id_foreign');
            $table->unsignedBigInteger('user_id')->index('campaigns_user_id_foreign');
            $table->string('status', 20)->default('pending');
            $table->time('campaign_time')->nullable();
            $table->date('campaign_date')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();
            $table->string('email_host', 191)->nullable();
            $table->longText('failed_reason')->nullable();
            $table->string('subject', 191);
            $table->string('attachments', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
