<?php

use Illuminate\Database\Seeder;

class SetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sets')->insert([
            'name' => 'Padma'
        ]);
        DB::table('sets')->insert([
            'name' => 'Meghna'
        ]);
        DB::table('sets')->insert([
            'name' => 'Jamuna'
        ]);
    }
}
