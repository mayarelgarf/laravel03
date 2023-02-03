<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;

class colorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert(['name' => 'black']);
        DB::table('colors')->insert(['name' => 'white']);
        DB::table('colors')->insert(['name' => 'blue']);
        DB::table('colors')->insert(['name' => 'Red']);
        
    }
}
