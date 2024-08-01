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
        Employee::updateOrCreate(
            ['id' => 'employee-001'],
            [
                'name' => 'Super Admin PDU',
                'username' => 'superadmin',
                'companyId' => 'company-001',
                'role' => 'superAdmin',
                'password' => 'superadmin1234',
            ]
        );
    }
}
