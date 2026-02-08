<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->string('mode')->nullable()->change();
            $table->date('date')->nullable()->change();
            $table->time('time')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('interview_schedules', function (Blueprint $table) {
            $table->string('mode')->nullable(false)->change();
        });
    }
};

