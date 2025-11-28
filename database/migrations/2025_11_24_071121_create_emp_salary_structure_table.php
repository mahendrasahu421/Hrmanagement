<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emp_salary_structure', function (Blueprint $table) {

            $table->id('emp_salary_str_id');

            $table->integer('employee_id');
            $table->integer('session_id');

            $table->float('basic');
            $table->float('hra');
            $table->float('conveyance');
            $table->float('bike_maintenance_allowance');
            $table->float('other_allowance');
            $table->float('medical_reimbursement');
            $table->float('mobile_allowance');
            $table->float('other_reimbursement');
            $table->float('statutory_bonus');

            $table->double('special_allowance');
            $table->double('pf');
            $table->double('esi');
            $table->double('gratuity');
            $table->double('total_company_contribution');
            $table->double('local_conveyance_expense');
            $table->double('liveries_stores');
            $table->double('books_periodicals');
            $table->double('PLI_next_year');
            $table->double('PLI_payable');
            $table->double('special_annual_retention_pay');
            $table->double('total_reimbursement');
            $table->double('annual_ctc');
            $table->double('performance_bonus');

            $table->text('performance_text');

            $table->float('state_posting_allowance');
            $table->float('monthly_gross');
            $table->float('monthly_ctc');

            $table->tinyInteger('status')->default(1);

            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emp_salary_structure');
    }
};
