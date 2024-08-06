<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code'  => 'IT',
                'name'  => 'Information Technology'
            ], [
                'code'  => 'HR',
                'name'  => 'Human Resource'
            ], [
                'code'  => 'FA',
                'name'  => 'Finance & Accounting'
            ], [
                'code'  => 'Facility',
                'name'  => 'Facility'
            ], [
                'code'  => 'OPR',
                'name'  => 'Operation'
            ], [
                'code'  => 'PROD',
                'name'  => 'Production'
            ], [
                'code'  => 'live Shoot',
                'name'  => 'Production Live Shoot'
            ]
        ];

        foreach ($data as $item) {
            Department::create($item);
        }
    }
}
