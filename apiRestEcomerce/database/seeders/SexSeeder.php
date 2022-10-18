<?php

namespace Database\Seeders;

use App\Models\Sex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sex::create(['nombre'=>'Mujeres']);
        Sex::create(['nombre'=>'Niñas']);
        Sex::create(['nombre'=>'Hombres']);
        Sex::create(['nombre'=>'Niños']);
    }
}
