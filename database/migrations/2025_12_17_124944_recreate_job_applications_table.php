<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
{
    Schema::dropIfExists('job_applications');

    Schema::create('job_applications', function (Blueprint $table) {
        $table->id();

        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->nullable();
        $table->string('phone');
        $table->string('aadhaar_number')->nullable();
        $table->date('dob');

        $table->unsignedBigInteger('gender');
        $table->unsignedBigInteger('marital_status');
        $table->unsignedBigInteger('state_id');
        $table->unsignedBigInteger('city_id');

        $table->string('resume')->nullable();

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

        $table->integer('experience_years')->nullable();
        $table->text('experience_details')->nullable();

        $table->longText('answers')->nullable();

        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('job_applications');
}

};
