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
        Schema::table('add_users', function (Blueprint $table) {
            $table->foreign(['group_id'])->references(['id'])->on('groups')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('add_users', function (Blueprint $table) {
            $table->dropForeign('add_users_group_id_foreign');
        });
    }
};
