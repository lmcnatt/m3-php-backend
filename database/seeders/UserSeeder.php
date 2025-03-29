<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Logan McNatt',
                'email' => 'logan.m.mcnatt@gmail.com',
                'email_verified_at' => null,
                'password' => bcrypt('1234asdf'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Leah McNatt',
                'email' => '13leah.rose@gmail.com',
                'email_verified_at' => null,
                'password' => bcrypt('asdf1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Shanden Hoffman',
                'email' => 'shandenhoffman@email.com',
                'email_verified_at' => null,
                'password' => bcrypt('asdf1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Natalie Jolley',
                'email' => 'nataliejolley@email.com',
                'email_verified_at' => null,
                'password' => bcrypt('asdf1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        User::insert($users);
    }
}
