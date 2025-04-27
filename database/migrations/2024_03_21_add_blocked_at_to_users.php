<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddBlockedAtToUsers extends Migration
{
    public function up()
    {
        // Add blocked_at column using Oracle syntax
        DB::statement('ALTER TABLE users ADD blocked_at TIMESTAMP');
    }

    public function down()
    {
        // Remove blocked_at column using Oracle syntax
        DB::statement('ALTER TABLE users DROP COLUMN blocked_at');
    }
} 