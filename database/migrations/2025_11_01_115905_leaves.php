<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('leaves', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->unsignedBigInteger('leave_type_id');
        $table->date('from_date');
        $table->date('to_date');
        $table->string('reason');
        $table->string('status')->default('Pending');
        $table->timestamps();

        $table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('cascade');
        $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
