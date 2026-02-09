<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_application_id');

            $table->string('round'); // e.g. HR Round, Technical Round, etc
            $table->enum('mode', ['offline', 'online', 'on_call']);
            $table->date('date');
            $table->time('time');
            $table->string('venue')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['cleared', 'rejected', 'postponed']);
            $table->text('comments')->nullable();

            $table->timestamps();

            $table->foreign('job_application_id')
                  ->references('id')
                  ->on('job_applications')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};
