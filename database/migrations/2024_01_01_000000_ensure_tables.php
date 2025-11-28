<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // This migration ensures all tables are created in correct order
        // The individual migrations should handle table creation
    }

    public function down()
    {
        // Don't drop tables in this migration
    }
};
