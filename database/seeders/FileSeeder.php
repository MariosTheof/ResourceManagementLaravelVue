<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pdf_files')->insert([
            [
                'name' => 'HireMe',
                'file_path' => '/public/uploads/1634809977_MariosAthanasiadisCV.pdf',
            ],
        ]);
    }
}
