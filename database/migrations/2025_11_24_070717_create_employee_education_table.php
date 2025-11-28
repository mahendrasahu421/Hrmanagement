<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_education', function (Blueprint $table) {

            $table->increments('emp_qualification_id');

            $table->unsignedBigInteger('employee_id');
            $table->string('qualLevel', 100);
            $table->year('qualYear');
            $table->year('qualCompletionYear');
            $table->integer('duration');
            $table->string('institute', 100);
            $table->string('university', 255);
            $table->string('grade', 20);

            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_education');
    }
};
