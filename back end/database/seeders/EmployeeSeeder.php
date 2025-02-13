<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('employees')->insert([
            ['name' => 'John Doe', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jane Smith', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alice Lee', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Robert Brown', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Emily Davis', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'David Wilson', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Linda Clark', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Michael Adams', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sarah Johnson', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'James White', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Olivia Garcia', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'William Martinez', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
