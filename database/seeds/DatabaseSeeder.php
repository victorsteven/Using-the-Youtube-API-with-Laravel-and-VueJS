<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(User::class)->create([
            'name' => 'Steven Victor',
            'email' => 'chikodi543@gmail.com',
            'password' => bcrypt('password'),
            'is_active' => 1
        ]);

        factory(User::class, 10)->create();
    }
}
