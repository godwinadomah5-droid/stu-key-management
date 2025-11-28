<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add foreign key constraint after key_logs table exists
        Schema::table('keys', function (Blueprint $table) {
            $table->foreign('last_log_id')->references('id')->on('key_logs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('keys', function (Blueprint $table) {
            $table->dropForeign(['last_log_id']);
        });
    }
};
