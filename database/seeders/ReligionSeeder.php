<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Religion;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religions = ["ইসলাম","হিন্দু","খ্রিস্টান","বৌদ্ধ"];
        foreach ($religions as $religion) {
            Religion::create([
                'title' => $religion,
                'slug' => preg_replace('/\s+/', '-', $religion),
                'status' => 1
            ]);
        }
    }
}
