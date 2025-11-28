<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpi_master', function (Blueprint $table) {

            $table->id('kpi_master_id');

            $table->integer('session_id');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('employee_id')->default(0);

            $table->text('objective');
            $table->text('kpi_name');

            $table->float('weightage');

            $table->tinyInteger('status')->default(1);

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpi_master');
    }
};
