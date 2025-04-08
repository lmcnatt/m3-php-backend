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
                'avatar' => 'images/1743268484_1.jpg',
                'email' => 'logan.m.mcnatt@gmail.com',
                'email_verified_at' => null,
                'password' => bcrypt('1234asdf'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Leah McNatt',
                'avatar' => 'images/1743268510_2.jpg',
                'email' => '13leah.rose@gmail.com',
                'email_verified_at' => null,
                'password' => bcrypt('asdf1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Shanden Hoffman',
                'avatar' => 'images/1743268536_3.jpg',
                'email' => 'shandenhoffman@email.com',
                'email_verified_at' => null,
                'password' => bcrypt('asdf1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Natalie Jolley',
                'avatar' => 'images/1743268553_4.jpeg',
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
