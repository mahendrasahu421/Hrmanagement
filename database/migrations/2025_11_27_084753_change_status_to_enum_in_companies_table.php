<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Boolean values ko ENUM values me convert karo
        DB::statement("ALTER TABLE companies CHANGE status status ENUM('Active','Inactive') NOT NULL DEFAULT 'Active'");

        // Step 2: Purana data 1 → Active, 0 → Inactive
        DB::statement("UPDATE companies SET status = CASE WHEN status = 1 THEN 'Active' ELSE 'Inactive' END");
    }

    public function down(): void
    {
        // ENUM ko wapas boolean me convert karo
        DB::statement("ALTER TABLE companies CHANGE status status TINYINT(1) NOT NULL DEFAULT 1");

        // Purana data wapas 1 → Active, 0 → Inactive
        DB::statement("UPDATE companies SET status = CASE WHEN status = 'Active' THEN 1 ELSE 0 END");
    }
};
