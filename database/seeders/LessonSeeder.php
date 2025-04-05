<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use App\Models\DanceStyle;
use App\Models\Dance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the primary student ID
        $student1Id = User::where('email', 'logan.m.mcnatt@gmail.com')->first()->id;
        
        // Get Leah McNatt as student2
        $student2Id = User::where('email', '13leah.rose@gmail.com')->first()->id;

        $ballroomId = DanceStyle::where('style', 'Ballroom')->first()->id;
        $latinId = DanceStyle::where('style', 'Latin')->first()->id;
        $smoothId = DanceStyle::where('style', 'Smooth')->first()->id;
        $rhythmId = DanceStyle::where('style', 'Rhythm')->first()->id;
        $cabaretId = DanceStyle::where('style', 'Cabaret')->first()->id;
        $countryId = DanceStyle::where('style', 'Country')->first()->id;

        $ballroomWaltzId = Dance::where('dance_style_id', $ballroomId)->where('dance', 'Waltz')->first()->id;
        $ballroomTangoId = Dance::where('dance_style_id', $ballroomId)->where('dance', 'Tango')->first()->id;
        $ballroomVienneseWaltzId = Dance::where('dance_style_id', $ballroomId)->where('dance', 'Viennese Waltz')->first()->id;
        $ballroomFoxtrotId = Dance::where('dance_style_id', $ballroomId)->where('dance', 'Foxtrot')->first()->id;
        $ballroomQuickstepId = Dance::where('dance_style_id', $ballroomId)->where('dance', 'Quickstep')->first()->id;

        $smoothWaltzId = Dance::where('dance_style_id', $smoothId)->where('dance', 'Waltz')->first()->id;
        $smoothTangoId = Dance::where('dance_style_id', $smoothId)->where('dance', 'Tango')->first()->id;
        $smoothFoxtrotId = Dance::where('dance_style_id', $smoothId)->where('dance', 'Foxtrot')->first()->id;
        $smoothVienneseWaltzId = Dance::where('dance_style_id', $smoothId)->where('dance', 'Viennese Waltz')->first()->id;
        $smoothPeabodyId = Dance::where('dance_style_id', $smoothId)->where('dance', 'Peabody')->first()->id;

        $latinChaChaId = Dance::where('dance_style_id', $latinId)->where('dance', 'Cha Cha')->first()->id;
        $latinSambaId = Dance::where('dance_style_id', $latinId)->where('dance', 'Samba')->first()->id;
        $latinRumbaId = Dance::where('dance_style_id', $latinId)->where('dance', 'Rumba')->first()->id;
        $latinPasoDobleId = Dance::where('dance_style_id', $latinId)->where('dance', 'Paso Doble')->first()->id;
        $latinJiveId = Dance::where('dance_style_id', $latinId)->where('dance', 'Jive')->first()->id;

        $rhythmChaChaId = Dance::where('dance_style_id', $rhythmId)->where('dance', 'Cha Cha')->first()->id;
        $rhythmRumbaId = Dance::where('dance_style_id', $rhythmId)->where('dance', 'Rumba')->first()->id;
        $rhythmSwingId = Dance::where('dance_style_id', $rhythmId)->where('dance', 'Swing')->first()->id;
        $rhythmBoleroId = Dance::where('dance_style_id', $rhythmId)->where('dance', 'Bolero')->first()->id;
        $rhythmMamboId = Dance::where('dance_style_id', $rhythmId)->where('dance', 'Mambo')->first()->id;

        $cabaretId = Dance::where('dance_style_id', $cabaretId)->where('dance', 'Cabaret')->first()->id;
        $countrySwingId = Dance::where('dance_style_id', $countryId)->where('dance', 'Country Swing')->first()->id;
        
        $lessons = [
            [
                'student1_id' => $student1Id,
                'student2_id' => $student2Id,
                'coach_id' => 3,
                'title' => 'Introduction to Waltz',
                'notes' => 'Learned basic waltz box step and natural turn. Need to work on posture and frame.',
                'dance_style_id' => $smoothId,
                'dance_id' => $smoothWaltzId,
                'lesson_date' => Carbon::now()->subDays(14),
                'video' => 'videos/Waltz Fix.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student1_id' => $student1Id,
                'student2_id' => null,
                'coach_id' => 3,
                'title' => 'Cha-Cha Timing',
                'notes' => 'Focused on Cuban motion and correct timing for basic steps. Homework: practice hip action.',
                'dance_style_id' => $rhythmId,
                'dance_id' => $rhythmChaChaId,
                'lesson_date' => Carbon::now()->subDays(7),
                'video' => 'videos/Cha Cha.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student1_id' => $student1Id,
                'student2_id' => $student2Id,
                'coach_id' => 4,
                'title' => 'Tango Fundamentals',
                'notes' => 'Worked on tango walk, staccato movement, and head position. Need to maintain connection with partner.',
                'dance_style_id' => $ballroomId,
                'dance_id' => $ballroomTangoId,
                'lesson_date' => Carbon::now()->subDays(3),
                'video' => 'videos/Tango.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student1_id' => $student1Id,
                'student2_id' => $student2Id,
                'coach_id' => 3,
                'title' => 'Rumba Technique',
                'notes' => 'Reviewed Cuban walks and sliding doors. Focus on weight transfers and hip rotation.',
                'dance_style_id' => $latinId,
                'dance_id' => $latinRumbaId,
                'lesson_date' => Carbon::now()->subDay(),
                'video' => 'videos/Rumba.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'student1_id' => $student1Id,
                'student2_id' => null,
                'coach_id' => 3,
                'title' => 'Quickstep Basics',
                'notes' => 'Introduced natural turn and quarter turn. Need to work on maintaining bounce and drive.',
                'dance_style_id' => $ballroomId,
                'dance_id' => $ballroomQuickstepId,
                'lesson_date' => Carbon::now(),
                'video' => 'videos/Quickstep.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        Lesson::insert($lessons);
    }
}
