<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LessonController extends BaseController
{
    /**
     * Display a listing of the user's lessons.
     */
    public function listMyLessons()
    {
        $authUser = Auth::user();
        $user = User::findOrFail($authUser->id);
        
        $lessons = Lesson::where('student1_id', $user->id)
            ->orWhere('student2_id', $user->id)
            ->with(['student1', 'student2', 'coach'])
            ->orderBy('lesson_date', 'desc')
            ->get();

        // Add S3 URLs for videos if they exist
        foreach ($lessons as $lesson) {
            if ($lesson->video) {
                $lesson->video = $this->getS3Url($lesson->video);
            }
        }

        return $this->sendResponse($lessons, 'Lessons retrieved successfully');
    }
    
    public function listStudentLessons()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createLesson()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function getLesson(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editLesson(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadLessonVideo(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLessonVideo(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteLessonVideo()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteLesson(string $id)
    {
        //
    }
}
