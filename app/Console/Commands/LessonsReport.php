<?php

namespace App\Console\Commands;

use App\Models\Lesson;
use App\Mail\LessonListMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class LessonsReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:lessons-report {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A report of all new lessons for the week';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sendToEmail = $this->option('email');
        if(!$sendToEmail) {
            return Command::FAILURE;
        }
        $lessons = Lesson::where('lesson_date', '>=', now()->startOfWeek())
            ->where('lesson_date', '<=', now()->endOfWeek())
            ->with(['student1', 'student2', 'coach', 'dance'])
            ->orderBy('lesson_date', 'desc')
            ->get();

        if ($lessons->count() > 0) {
            //Send one main list of all overdue books email to management
            Mail::to($sendToEmail)->send(new LessonListMail($lessons));
        }
                

        return Command::SUCCESS;

    }
}
