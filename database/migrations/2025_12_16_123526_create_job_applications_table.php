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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            // Resume
            $table->string('resume');

            // Personal Info
            $table->string('name');
            $table->string('email');
            $table->date('dob');
            $table->unsignedBigInteger('gender');
            $table->unsignedBigInteger('marital_status');
            $table->unsignedBigInteger('state');
            $table->unsignedBigInteger('city');
            $table->string('phone');

            // Academic
            $table->string('tenth_percent')->nullable();
            $table->string('tenth_year')->nullable();
            $table->string('twelfth_percent')->nullable();
            $table->string('twelfth_year')->nullable();
            $table->string('ug_percent')->nullable();
            $table->string('ug_year')->nullable();
            $table->string('qualification')->nullable();
            $table->string('degree')->nullable();
            $table->string('institute')->nullable();

            // Experience
            $table->string('experience_years')->nullable();
            $table->string('last_company')->nullable();

            // Job Questions Answers
            $table->longText('answers')->nullable(); // JSON

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
