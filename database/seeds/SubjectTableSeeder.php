<?php

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'name' => 'Bangla'
        ]);
        DB::table('subjects')->insert([
            'name' => 'English'
        ]);
        DB::table('subjects')->insert([
            'name' => 'Math'
        ]);
    }
}
