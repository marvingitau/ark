<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'email' => 'admin@proj.com',
                'phone' => '254722000000',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('admin'),
                'role' => Role::ADMIN,
                'avatar' => 'avatar.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fname' => 'Jane',
                'lname' => 'Doe',
                'email' => 'user@proj.com',
                'phone' => '254722000000',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('user'),
                'role' => Role::USER,
                'avatar' => 'avatar.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        User::insert($users);
    }
}
