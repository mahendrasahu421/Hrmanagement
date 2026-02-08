<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->text('comments')->nullable()->change();
        });
    }
    public function down(): void
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->string('status')->nullable(false)->change();
            $table->text('comments')->nullable(false)->change();
        });
    }
};
