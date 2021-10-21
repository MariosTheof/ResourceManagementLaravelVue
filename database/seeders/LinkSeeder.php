<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            [
                'title' => 'Google',
                'url' => 'google.com',
                'opens_new_tab' => 0
            ],
            [
                'title' => 'Temperature',
                'url' => 'temperature.gr',
                'opens_new_tab' => 1
            ]
        ]);
    }
}
