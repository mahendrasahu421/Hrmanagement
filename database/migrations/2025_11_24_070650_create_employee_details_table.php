<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_details', function (Blueprint $table) {

            $table->increments('employee_detail_id');

            $table->unsignedBigInteger('employee_id');
            $table->date('DOB');

            $table->integer('present_district');
            $table->integer('present_state');
            $table->string('present_address', 255);

            $table->integer('parmanent_state');
            $table->integer('parmanent_district');
            $table->string('parmanent_address', 255);

            $table->tinyInteger('marital_status')->comment('1 for yes 2 for no');
            $table->string('spouse_name', 120);
             $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};
