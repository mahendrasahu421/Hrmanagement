<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_experience', function (Blueprint $table) {

            $table->increments('employee_exp_id');

            $table->unsignedBigInteger('employee_id');

            $table->string('company_name', 100);
            $table->string('department', 100);
            $table->integer('designation');

            $table->date('org_joining_date');
            $table->date('last_working_date')->nullable();

            $table->tinyInteger('exp_in_acfl')->comment('1 FOR yes, 2 For No');

            $table->float('total_exp');
            $table->tinyInteger('status');
             $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_experience');
    }
};
