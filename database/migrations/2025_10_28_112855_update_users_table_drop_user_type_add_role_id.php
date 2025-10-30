<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the old column if it exists
            if (Schema::hasColumn('users', 'user_type')) {
                $table->dropColumn('user_type');
            }

            // Add new column
            $table->unsignedBigInteger('role_id')->nullable()->after('id');

            // Optional: add foreign key reference to roles table
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback actions
            $table->dropColumn('role_id');
            $table->string('user_type')->nullable();
        });
    }
};
