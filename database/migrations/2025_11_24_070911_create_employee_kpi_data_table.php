<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_kpi_data', function (Blueprint $table) {
            $table->id('emp_kpi_data_id');
            $table->integer('session_id');
            $table->integer('emp_id');
            $table->integer('department_id');
            $table->integer('designation_id');

            $table->text('kpi_objective');
            $table->text('kpi_name');
            $table->text('kpi_range');

            $table->float('weightage');
            $table->float('emp_target');
            $table->float('emp_actual');
            $table->float('achievement');
            $table->float('rating');
            $table->float('score');

            $table->text('emp_feedback');
            $table->float('co_rating');
            $table->float('co_score');
            $table->text('co_feedback');

            $table->tinyInteger('status')->default(1)
                  ->comment('1=new, 2=draft, 3=submit, 4=CO draft, 5=final submit');

            $table->timestamps(); // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_kpi_data');
    }
};
