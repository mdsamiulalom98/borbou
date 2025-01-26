<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaritalStatus;

class MaritalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maritals = ["অবিবাহিত","তালাকপ্রাপ্ত","বিধবা","বিপত্নীক","বিবাহবিচ্ছেদ"];

        foreach ($maritals as $marital) {
            MaritalStatus::create([
                'title' => $marital,
                'slug' => preg_replace('/\s+/', '-', $marital),
                'status' => 1
            ]);
        }
    }
}
