<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_manager_mapping', function (Blueprint $table) {
            $table->id('emp_manager_id');

            $table->integer('session_id');
            $table->integer('employee_id');
            $table->integer('co_id');
            $table->integer('rm_id');

            $table->tinyInteger('status')->default(1);

            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_manager_mapping');
    }
};
