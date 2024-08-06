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
            [
                'name' => 'Super Admin PDU',
                'username' => 'superadmin',
                'companyId' => 'c60d1108-130c-42c7-9e94-c773460bdfe1',
                'role' => 'superAdmin',
                'password' => 'superadmin1234',
            ]
        );
    }
}
