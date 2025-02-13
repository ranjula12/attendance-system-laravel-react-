<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        DB::table('attendance')->insert([
            ['employee_id' => 1, 'date' => '2025-01-01', 'status' => 'present', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 2, 'date' => '2025-01-01', 'status' => 'short leave', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 3, 'date' => '2025-01-01', 'status' => 'absent', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 1, 'date' => '2025-01-02', 'status' => 'present', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 2, 'date' => '2025-01-02', 'status' => 'absent', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 3, 'date' => '2025-01-02', 'status' => 'present', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 1, 'date' => '2025-01-03', 'status' => 'short leave', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 2, 'date' => '2025-01-03', 'status' => 'present', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 3, 'date' => '2025-01-03', 'status' => 'absent', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 1, 'date' => '2025-01-04', 'status' => 'absent', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 2, 'date' => '2025-01-04', 'status' => 'present', 'created_at' => now(), 'updated_at' => now()],
            ['employee_id' => 3, 'date' => '2025-01-04', 'status' => 'present', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
    }
}
