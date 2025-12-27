<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $leaveTypes = [
            [
                'company_id' => 1,
                'leave_name' => 'Casual Leave',
                'leave_code' => 'CL',
                'total_leaves' => 12,
                'carry_forward' => 0,
                'encashable' => 0,
                'applicable_for' => 'All',
                'leave_category' => 'Paid',
                'status' => 'Active',
                'description' => 'Casual leaves for personal reasons',
            ],
            [
                'company_id' => 1,
                'leave_name' => 'Sick Leave',
                'leave_code' => 'SL',
                'total_leaves' => 10,
                'carry_forward' => 1,
                'encashable' => 0,
                'applicable_for' => 'All',
                'leave_category' => 'Paid',
                'status' => 'Active',
                'description' => 'Leaves for medical reasons',
            ],
            [
                'company_id' => 1,
                'leave_name' => 'Earned Leave',
                'leave_code' => 'EL',
                'total_leaves' => 15,
                'carry_forward' => 1,
                'encashable' => 1,
                'applicable_for' => 'All',
                'leave_category' => 'Paid',
                'status' => 'Active',
                'description' => 'Accrued leaves which can be carried forward and encashed',
            ],
            [
                'company_id' => 1,
                'leave_name' => 'Maternity Leave',
                'leave_code' => 'ML',
                'total_leaves' => 180,
                'carry_forward' => 0,
                'encashable' => 0,
                'applicable_for' => 'Female',
                'leave_category' => 'Special',
                'status' => 'Active',
                'description' => 'Maternity leave for female employees',
            ],
            [
                'company_id' => 1,
                'leave_name' => 'Unpaid Leave',
                'leave_code' => 'UL',
                'total_leaves' => 0,
                'carry_forward' => 0,
                'encashable' => 0,
                'applicable_for' => 'All',
                'leave_category' => 'Unpaid',
                'status' => 'Active',
                'description' => 'Leaves without pay',
            ],
        ];

        foreach ($leaveTypes as $leave) {
            DB::table('leave_types')->insert(array_merge($leave, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
