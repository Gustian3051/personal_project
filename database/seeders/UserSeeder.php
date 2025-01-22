<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::create([
            'name' => 'Gustian Prayoga Januar',
            'username' => 'owner',
            'email' => 'owner@localhost.com',
            'password' => Hash::make('password'),
        ]);

        $owner->assignRole('Owner');
    }
}
