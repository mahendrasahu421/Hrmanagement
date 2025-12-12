<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJafQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('jaf_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');       // Job Id
            $table->string('question');                 // Question Text
            $table->string('text_element');             // Text / Radio / Checkbox etc.
            $table->integer('order')->default(0);       // Question order
            $table->enum('is_required', ['Yes', 'No']); // Required or Not
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('acfl_jobs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jaf_questions');
    }
}
