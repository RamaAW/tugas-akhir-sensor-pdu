<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Employee::create([
            'id' => 'employee-001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'companyId' => 'company-001',
            'role' => 'admin',
            'password' => 'admin1234',
        ]);
    }
}
