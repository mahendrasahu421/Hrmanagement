<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_reasons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('leave_type_id');
            $table->string('reason');

            $table->enum('status', ['Active', 'Inactive'])
                ->default('Active');

            $table->timestamps();
            $table->foreign('leave_type_id')
                ->references('id')
                ->on('leave_types')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_reasons');
    }
};
