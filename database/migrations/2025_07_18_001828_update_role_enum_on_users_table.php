<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       DB::statement("ALTER TABLE users MODIFY role ENUM('operator', 'supervisor', 'admin') DEFAULT 'operator'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
