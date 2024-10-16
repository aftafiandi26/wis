<?php

namespace Database\Seeders;

use App\Models\LeaveCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveCategory::create([
            'name' => 'Annual'
        ]);

        LeaveCategory::create([
            'name' => 'Exdo'
        ]);

        LeaveCategory::create([
            'name' => 'Sick'
        ]);

        LeaveCategory::create([
            'name' => 'Wedding (3 Days)'
        ]);

        LeaveCategory::create([
            'name' => 'Birth Of Child (2 Days)'
        ]);

        LeaveCategory::create([
            'name' => 'Unpaid'
        ]);

        LeaveCategory::create([
            'name' => 'Son Circumcision / Baptism (2 Days)'
        ]);

        LeaveCategory::create([
            'name' => 'Death of Family (3 Days)'
        ]);

        LeaveCategory::create([
            'name' => 'Death of Family in Law (2 Days)'
        ]);

        LeaveCategory::create([
            'name' => 'Maternity (3 Months)'
        ]);

        LeaveCategory::create([
            'name' => 'Others'
        ]);
    }
}
