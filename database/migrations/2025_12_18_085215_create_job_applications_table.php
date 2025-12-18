<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_job_applications_table.php
public function up()
{
    Schema::create('job_applications', function (Blueprint $table) {
        $table->id();

        // Personal
        $table->string('resume')->nullable();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->nullable();
        $table->string('phone');
        $table->string('aadhaar_number', 12)->nullable();
        $table->date('dob');
        $table->unsignedBigInteger('gender_id');
        $table->unsignedBigInteger('marital_status_id');
        $table->unsignedBigInteger('state_id');
        $table->unsignedBigInteger('city_id');

        // Skills (multiple)
        $table->json('skills');

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
        $table->string('final_year')->nullable();

        // Experience
        $table->string('experience_years')->nullable();
        $table->string('experience_details')->nullable();

        // Job Questions Answers
        $table->json('answers')->nullable();

        // Status (onboarding flow)
        $table->enum('status', [
            'applied',
            'shortlisted',
            'interview_scheduled',
            'interview_postponed',
            'selected',
            'rejected'
        ])->default('applied');

        $table->timestamps();
    });
}

};
