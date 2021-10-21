<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SnippetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('snippets')->insert([
            [
            'title' => 'Link',
            'desc' => 'Html snippet for links',
            'snip' => "<a href='#'></a>"
            ],
            [
            'title' => 'Button',
            'desc' => 'Html snippet for buttons',
            'snip' => "<button></button>"
            ]
        ]);
    }
}
