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
        Schema::table('ticket_messages', function (Blueprint $table) {
            $table->foreign(['ticket_id'])->references(['id'])->on('tickets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_messages', function (Blueprint $table) {
            $table->dropForeign('ticket_messages_ticket_id_foreign');
        });
    }
};
