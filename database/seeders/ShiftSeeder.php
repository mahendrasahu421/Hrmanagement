<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $shifts = [
            [
                'shift_name' => 'Morning Shift',
                'shift_code' => 'MORNING',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'break_duration' => 60, // minutes
                'total_working_hours' => 8.00,
                'status' => 'Active',
            ],
            [
                'shift_name' => 'Evening Shift',
                'shift_code' => 'EVENING',
                'start_time' => '14:00:00',
                'end_time' => '22:00:00',
                'break_duration' => 60,
                'total_working_hours' => 8.00,
                'status' => 'Active',
            ],
            [
                'shift_name' => 'Night Shift',
                'shift_code' => 'NIGHT',
                'start_time' => '22:00:00',
                'end_time' => '06:00:00',
                'break_duration' => 60,
                'total_working_hours' => 8.00,
                'status' => 'Inactive',
            ],
        ];

        foreach ($shifts as $shift) {
            DB::table('shifts')->insert(array_merge($shift, [
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]));
        }
    }
}
