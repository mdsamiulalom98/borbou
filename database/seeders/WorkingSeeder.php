<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Working;

class WorkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workings = ["সরকারি","বেসরকারী","অর্ধেক সরকারি","স্বায়ত্তশাসিত","গৃহিণী","শিক্ষার্থী","ব্যবসা","আত্মনির্ভরশীল","বেকার / কর্মহীন","অবসরপ্রাপ্ত"];
        foreach ($workings as $working) {
            Working::create([
                'title' => $working,
                'slug' => preg_replace('/\s+/', '-', $working),
                'status' => 1
            ]);
        }
    }
}
