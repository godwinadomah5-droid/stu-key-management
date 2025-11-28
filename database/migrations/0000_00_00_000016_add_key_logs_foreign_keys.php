<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add foreign key constraint after all tables exist
        Schema::table('key_logs', function (Blueprint $table) {
            $table->foreign('returned_from_log_id')->references('id')->on('key_logs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('key_logs', function (Blueprint $table) {
            $table->dropForeign(['returned_from_log_id']);
        });
    }
};
