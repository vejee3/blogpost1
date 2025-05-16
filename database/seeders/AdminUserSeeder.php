<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'balabat.vj@gmail.com'], // Find by email
            [
                'password' => bcrypt('12345678'), // Hash the password
                'is_admin' => true, // Set as admin
            ]
        );
    }
}
