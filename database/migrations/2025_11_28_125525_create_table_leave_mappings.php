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
        Schema::create('leave_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('leave_type_id');
            $table->string('status')->default('Active');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_leave_mappings');
    }
};
