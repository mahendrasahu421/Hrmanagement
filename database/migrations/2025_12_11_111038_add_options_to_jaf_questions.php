<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('jaf_questions', function (Blueprint $table) {
        $table->longText('options')->nullable();
    });
}

public function down()
{
    Schema::table('jaf_questions', function (Blueprint $table) {
        $table->dropColumn('options');
    });
}

};
