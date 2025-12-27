<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'company_name' => 'Madhav Pipes',
                'company_code' => 'MP001',
                'company_logo' => null,
                'contact_no' => '9876543210',
                'landline_no' => null,
                'email' => 'info@madhavpipes.com',
                'gst_no' => '22AAAAA0000A1Z5',
                'pan_no' => 'AAAAA0000A',
                'cin_no' => 'U12345CG2024PTC000001',
                'iec' => null,
                'website' => 'https://madhavpipes.com',
                'address' => 'Industrial Area, Raipur',
                'country' => 'India',
                'state' => 'Chhattisgarh',
                'city' => 'Raipur',
                'pincode' => '492001',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'company_name' => 'Adi Chitragupt Finances Limited',
                'company_code' => 'ACFL001',
                'company_logo' => null,
                'contact_no' => '9123456789',
                'landline_no' => null,
                'email' => 'contact@roshaniindustries.com',
                'gst_no' => '22BBBBB1111B1Z6',
                'pan_no' => 'BBBBB1111B',
                'cin_no' => 'U67890CG2024PTC000002',
                'iec' => null,
                'website' => null,
                'address' => 'MIDC Area, Bhilai',
                'country' => 'India',
                'state' => 'Chhattisgarh',
                'city' => 'Bhilai',
                'pincode' => '490001',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
