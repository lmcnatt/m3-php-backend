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
        // Get the user ID to associate with lessons
        $userId = User::where('email', 'logan.m.mcnatt@gmail.com')->first()->id;
        
        $lessons = [
            [
                'user_id' => $userId,
                'title' => 'Introduction to Waltz',
                'notes' => 'Learned basic waltz box step and natural turn. Need to work on posture and frame.',
                'dance_style' => 'Waltz',
                'lesson_date' => Carbon::now()->subDays(14),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => $userId,
                'title' => 'Cha-Cha Timing',
                'notes' => 'Focused on Cuban motion and correct timing for basic steps. Homework: practice hip action.',
                'dance_style' => 'Cha-Cha',
                'lesson_date' => Carbon::now()->subDays(7),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => $userId,
                'title' => 'Tango Fundamentals',
                'notes' => 'Worked on tango walk, staccato movement, and head position. Need to maintain connection with partner.',
                'dance_style' => 'Tango',
                'lesson_date' => Carbon::now()->subDays(3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => $userId,
                'title' => 'Rumba Technique',
                'notes' => 'Reviewed Cuban walks and sliding doors. Focus on weight transfers and hip rotation.',
                'dance_style' => 'Rumba',
                'lesson_date' => Carbon::now()->subDay(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => $userId,
                'title' => 'Quickstep Basics',
                'notes' => 'Introduced natural turn and quarter turn. Need to work on maintaining bounce and drive.',
                'dance_style' => 'Quickstep',
                'lesson_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        Lesson::insert($lessons);
    }
}
