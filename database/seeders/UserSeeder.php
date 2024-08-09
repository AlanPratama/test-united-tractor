<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $datas = [
            [
                "email" => "user1@gmail.com",
                "password" => "user1234"
            ],
            [
                "email" => "user2@gmail.com",
                "password" => "user1234"
            ],
            [
                "email" => "user3@gmail.com",
                "password" => "user1234"
            ],
            [
                "email" => "user4@gmail.com",
                "password" => "user1234"
            ],
            [
                "email" => "user5@gmail.com",
                "password" => "user1234"
            ],
            [
                "email" => "user6@gmail.com",
                "password" => "user1234"
            ],
            [
                "email" => "user7@gmail.com",
                "password" => "user1234"
            ],
            [
                "email" => "user8@gmail.com",
                "password" => "user1234"
            ],
        ];

        foreach ($datas as $data) {
            User::create($data);
        }

    }
}
