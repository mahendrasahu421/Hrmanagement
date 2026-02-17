<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE job_applications 
            MODIFY status ENUM(
                'applied',
                'shortlisted',
                'interview_scheduled',
                'interview_postponed',
                'selected',
                'rejected',
                'interview_rejected',
                'join',
                'confirmation'
            ) NOT NULL DEFAULT 'applied'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE job_applications 
            MODIFY status ENUM(
                'applied',
                'shortlisted',
                'interview_scheduled',
                'interview_postponed',
                'selected',
                'rejected',
                'interview_rejected'
            ) NOT NULL DEFAULT 'applied'");
    }
};
