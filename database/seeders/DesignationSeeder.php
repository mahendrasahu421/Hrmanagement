<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DesignationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $designations = [
            ['department_id' => 1, 'name' => 'Deputy Branch Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 1, 'name' => 'Senior Branch Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 1, 'name' => 'Senior Vice President', 'kpi' => 80, 'comp' => 20],
            ['department_id' => 1, 'name' => 'Area Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 1, 'name' => 'Branch Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 1, 'name' => 'Deputy Regional Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 1, 'name' => 'Area Incharge', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 1, 'name' => 'Management Trainee', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 1, 'name' => 'Regional Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 1, 'name' => 'Grahak Mitra', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 1, 'name' => 'Senior Grahak Mitra', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 1, 'name' => 'Assistant Branch Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 1, 'name' => 'Assistant Branch Manager- Business & Recovery', 'kpi' => 90, 'comp' => 10],

            ['department_id' => 2, 'name' => 'Credit & Quality Executive', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 2, 'name' => 'Junior Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 2, 'name' => 'Deputy Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 2, 'name' => 'Senior Manager', 'kpi' => 85, 'comp' => 15],

            ['department_id' => 3, 'name' => 'Senior Manager & Company Secretary', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 3, 'name' => 'Assistant Vice President', 'kpi' => 85, 'comp' => 15],

            ['department_id' => 4, 'name' => 'Junior Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 4, 'name' => 'Senior Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 4, 'name' => 'Deputy Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 4, 'name' => 'Senior Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 4, 'name' => 'Management Trainee', 'kpi' => 85, 'comp' => 15],

            ['department_id' => 5, 'name' => 'Finance & Accounts Assistant Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 5, 'name' => 'Assistant Accounts Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 5, 'name' => 'Deputy Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 5, 'name' => 'Senior Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 5, 'name' => 'Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 5, 'name' => 'Senior Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 5, 'name' => 'CFO', 'kpi' => 70, 'comp' => 30],
            ['department_id' => 5, 'name' => 'Assistant Vice President', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 5, 'name' => 'Executive', 'kpi' => 90, 'comp' => 10],

            ['department_id' => 6, 'name' => 'Senior Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 6, 'name' => 'Junior Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 6, 'name' => 'Assistant Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 6, 'name' => 'Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 6, 'name' => 'Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 6, 'name' => 'Senior Manager', 'kpi' => 0, 'comp' => 0],

            ['department_id' => 7, 'name' => 'Assistant Vice President', 'kpi' => 80, 'comp' => 20],
            ['department_id' => 7, 'name' => 'Assistant Manager', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 7, 'name' => 'Senior Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 7, 'name' => 'Junior Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 7, 'name' => 'Deputy Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 7, 'name' => 'Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 7, 'name' => 'Senior Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 7, 'name' => 'Management Trainee', 'kpi' => 90, 'comp' => 10],

            ['department_id' => 9, 'name' => 'Senior Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 9, 'name' => 'Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 9, 'name' => 'Junior Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 9, 'name' => 'Senior Manager', 'kpi' => 0, 'comp' => 0],

            ['department_id' => 10, 'name' => 'Vice President', 'kpi' => 80, 'comp' => 20],
            ['department_id' => 10, 'name' => 'Senior Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 10, 'name' => 'Executive', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 10, 'name' => 'Assistant Vice President', 'kpi' => 90, 'comp' => 10],
            ['department_id' => 10, 'name' => 'Assistant Manager', 'kpi' => 90, 'comp' => 10],

            ['department_id' => 12, 'name' => 'Deputy Manager', 'kpi' => 85, 'comp' => 15],
            ['department_id' => 12, 'name' => 'Junior Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 12, 'name' => 'Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 12, 'name' => 'Senior Manager', 'kpi' => 0, 'comp' => 0],

            ['department_id' => 13, 'name' => 'Deputy Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 13, 'name' => 'Junior Manager', 'kpi' => 0, 'comp' => 0],

            ['department_id' => 14, 'name' => 'CEO', 'kpi' => 70, 'comp' => 30],
            ['department_id' => 14, 'name' => 'Manager', 'kpi' => 90, 'comp' => 10],

            ['department_id' => 15, 'name' => 'Branch Manager', 'kpi' => 0, 'comp' => 0],
            ['department_id' => 15, 'name' => 'Senior Relationship Manager', 'kpi' => 0, 'comp' => 0],
        ];

        foreach ($designations as $d) {
            $category_id = match($d['department_id']) {
                1, 7, 9 => 7,
                2, 10 => 2,
                3, 14 => 3,
                4, 12 => 5,
                5, 15 => 4,
                6 => 6,
                13 => 1,
                default => null
            };

            // Unique code generate karte hue random 3 chars add kiye
            $slug = Str::slug($d['name']);
            $uniqueCode = Str::upper(substr($slug, 0, 6)) . Str::upper(Str::random(3));

            DB::table('designations')->insert([
                'company_id' => 1,
                'category_id' => $category_id,
                'department_id' => $d['department_id'],
                'name' => $d['name'],
                'code' => $uniqueCode,
                'kpi_weightage' => $d['kpi'],
                'competency_weight' => $d['comp'],
                'status' => 'Active',
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);
        }
    }
}
