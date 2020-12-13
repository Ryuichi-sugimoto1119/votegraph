<?php

use Illuminate\Database\Seeder;

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
        // $this->call(testTableSeeder::class);
        $this->call(postTableSeeder::class);
        $this->call(answerTableSeeder::class);
        $this->call(playerTableSeeder::class);
        $this->call(commentTableSeeder::class);
    }
}
