<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dance;
use App\Models\DanceStyle;
use Carbon\Carbon;

class DanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ballroomId = DanceStyle::where('style', 'Ballroom')->first()->id;
        $latinId = DanceStyle::where('style', 'Latin')->first()->id;
        $smoothId = DanceStyle::where('style', 'Smooth')->first()->id;
        $rhythmId = DanceStyle::where('style', 'Rhythm')->first()->id;
        $cabaretId = DanceStyle::where('style', 'Cabaret')->first()->id;
        $countryId = DanceStyle::where('style', 'Country')->first()->id;

        $dances = [
            [
                'dance_style_id' => $ballroomId,
                'dance' => 'Waltz',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $ballroomId,
                'dance' => 'Tango',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $ballroomId,
                'dance' => 'Viennese Waltz',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $ballroomId,
                'dance' => 'Foxtrot',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $ballroomId,
                'dance' => 'Quickstep',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $latinId,
                'dance' => 'Cha Cha',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $latinId,
                'dance' => 'Samba',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $latinId,
                'dance' => 'Rumba',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $latinId,
                'dance' => 'Paso Doble',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $latinId,
                'dance' => 'Jive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $smoothId,
                'dance' => 'Waltz',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $smoothId,
                'dance' => 'Tango',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $smoothId,
                'dance' => 'Foxtrot',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $smoothId,
                'dance' => 'Viennese Waltz',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $smoothId,
                'dance' => 'Peabody',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $rhythmId,
                'dance' => 'Cha Cha',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $rhythmId,
                'dance' => 'Rumba',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $rhythmId,
                'dance' => 'Swing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $rhythmId,
                'dance' => 'Bolero',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $rhythmId,
                'dance' => 'Mambo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $cabaretId,
                'dance' => 'Cabaret',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance_style_id' => $countryId,
                'dance' => 'Country Swing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        Dance::insert($dances);
    }
}
