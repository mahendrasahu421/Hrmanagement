<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveMapping extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Example leave mappings
        $leaveMappings = [
            [
                'designation_id' => 1, // Deputy Branch Manager
                'leave_type_id' => 1,  // Casual Leave
                'allow_days' => 12,
                'status' => 'Active',
            ],
            [
                'designation_id' => 1,
                'leave_type_id' => 2,  // Sick Leave
                'allow_days' => 10,
                'status' => 'Active',
            ],
            [
                'designation_id' => 2, // Senior Branch Manager
                'leave_type_id' => 1,
                'allow_days' => 12,
                'status' => 'Active',
            ],
            [
                'designation_id' => 2,
                'leave_type_id' => 3, // Earned Leave
                'allow_days' => 15,
                'status' => 'Active',
            ],
            [
                'designation_id' => 3, // Regional Manager
                'leave_type_id' => 1,
                'allow_days' => 12,
                'status' => 'Active',
            ],
            [
                'designation_id' => 3,
                'leave_type_id' => 2,
                'allow_days' => 10,
                'status' => 'Active',
            ],
            [
                'designation_id' => 3,
                'leave_type_id' => 3,
                'allow_days' => 15,
                'status' => 'Active',
            ],
        ];

        foreach ($leaveMappings as $mapping) {
            DB::table('leave_mappings')->insert(array_merge($mapping, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
