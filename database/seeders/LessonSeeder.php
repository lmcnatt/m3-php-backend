<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
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
        
        // Get coaches
        $coaches = User::whereIn('email', ['shandenhoffman@email.com', 'nataliejolley@email.com'])->get();
        
        $lessons = [
            [
                'student1_id' => $student1Id,
                'student2_id' => $student2Id,
                'coach_id' => 3,
                'title' => 'Introduction to Waltz',
                'notes' => 'Learned basic waltz box step and natural turn. Need to work on posture and frame.',
                'dance_style' => 'Smooth',
                'dance' => 'Waltz',
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
                'dance_style' => 'Rhythm',
                'dance' => 'Cha-Cha',
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
                'dance_style' => 'Ballroom',
                'dance' => 'Tango',
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
                'dance_style' => 'Latin',
                'dance' => 'Rumba',
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
                'dance_style' => 'Ballroom',
                'dance' => 'Quickstep',
                'lesson_date' => Carbon::now(),
                'video' => 'videos/Quickstep.mp4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        Lesson::insert($lessons);
    }
}
