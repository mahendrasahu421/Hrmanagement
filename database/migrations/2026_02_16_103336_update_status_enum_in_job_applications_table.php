<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE job_applications 
            MODIFY status ENUM(
                'applied',
                'shortlisted',
                'interview_scheduled',
                'interview_postponed',
                'selected',
                'rejected',
                'interview_rejected'
            ) DEFAULT 'applied'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE job_applications 
            MODIFY status ENUM(
                'applied',
                'shortlisted',
                'interview_scheduled',
                'interview_postponed',
                'selected',
                'rejected'
            ) DEFAULT 'applied'
        ");
    }
};
