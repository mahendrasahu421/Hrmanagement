<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Sick Leave, Casual Leave
            $table->text('description')->nullable(); // Optional details
            $table->integer('days')->default(0); // Number of days allowed per year
            $table->boolean('status')->default(true); // Active/Inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }



};
