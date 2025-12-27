<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryMasterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [

                'name' => 'Key Resources',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'Audit & Quality',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'Strategy & Corporate Communication',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'F&A',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'Human Resources',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'Profit Center Head',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'Operations',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'IT Support',
                'status' => 'Active',
                'created_at' => '2024-05-30',
            ],
            [

                'name' => 'Support Staff',
                'status' => 'Active', // example inactive
                'created_at' => '2024-05-30',
            ],
        ]);
    }
}
