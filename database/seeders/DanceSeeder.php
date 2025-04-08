<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dance;
use Carbon\Carbon;

class DanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dances = [
            [
                'dance' => 'Waltz',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Tango',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Viennese Waltz',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Foxtrot',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Quickstep',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Peabody',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Cha Cha',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Samba',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Rumba',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Paso Doble',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Jive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Swing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Bolero',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Mambo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Cabaret',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'dance' => 'Country',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        Dance::insert($dances);
    }
}
