<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Complexion;

class SkincolorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $complexions = ["ফর্সা","শ্যামলা ","উজ্জ্বল শ্যামলা ","কালো "];
        foreach ($complexions as $complexion) {
            Complexion::create([
                'title' => $complexion,
                'slug' => preg_replace('/\s+/', '-', $complexion),
                'status' => 1
            ]);
        }
    }
}
