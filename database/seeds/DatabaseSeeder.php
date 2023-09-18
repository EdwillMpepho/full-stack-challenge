<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //$this->call(UserSeeder::class);
      $users = [
        [
            'name' => 'Branko Ilic',
            'email' => 'branckoilic@gmail.com',
            'password' =>  bcrypt('secret'),
            'role' => 0,
            'banned' =>false
        ],
        [
            'name' => 'Mpepho Themba',
            'email' => 'mpephothemba@gmail.com',
            'password' =>  bcrypt('secret'),
            'role' => 1,
            'banned' =>false
        ],
        [
            'name' => 'Noluthando Zulu',
            'email' => 'noluthandozulu@gmail.com',
            'password' =>  bcrypt('secret'),
            'role' => 2,
            'banned' =>false
        ],
        [
            'name' => 'Jacob Harison',
            'email' => 'jacobharrison@yahoo.com',
            'password' =>  bcrypt('secret'),
            'role' => 2,
            'banned' =>false
        ],
        [
            'name' => 'Brandy Thompson',
            'email' => 'bradythompson@gmail.com',
            'password' =>  bcrypt('secret'),
            'role' => 2,
            'banned' =>false
        ],
    ];
    foreach($users as $user)
    {
        User::create($user);
    }
  }
}
