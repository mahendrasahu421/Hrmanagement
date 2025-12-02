<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acfl_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('job_title');
            $table->unsignedBigInteger('designation_id');
            $table->string('test_skills');
            $table->integer('positions')->default(1);
            $table->unsignedBigInteger('job_type_id');
            $table->decimal('ctc_from', 8, 2)->nullable();
            $table->decimal('ctc_to', 8, 2)->nullable();
            $table->integer('min_exp')->nullable();
            $table->integer('max_exp')->nullable();
            $table->unsignedBigInteger('state_id');
            $table->json('city_ids'); // multiple cities
            $table->text('job_description');
            $table->json('qualifications'); // multiple qualifications
            $table->string('keywords')->nullable();
            $table->date('interview_date')->nullable();
            $table->enum('status', ['DRAFT', 'PUBLISHED'])->default('DRAFT');
            $table->timestamps();

            // Foreign keys (optional, if tables exist)
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            // $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            // $table->foreign('job_type_id')->references('id')->on('job_categories')->onDelete('cascade');
            // $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
