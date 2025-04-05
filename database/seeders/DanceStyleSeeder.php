<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DanceStyle;
use Carbon\Carbon;

class DanceStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $danceStyles = [
            [
                'style' => 'Ballroom',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'style' => 'Latin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'style' => 'Smooth',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'style' => 'Rhythm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            
            [
                'style' => 'Cabaret',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'style' => 'Country',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        DanceStyle::insert($danceStyles);
    }
}
