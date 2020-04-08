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
        $this->call(UsersTableSeeder::class);
        // $this->call(SetTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        // $this->call(QuestionTableSeeder::class);
    }
}
