<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    
    /**
     * Display a listing of lessons for a specific student where the authenticated user is the coach.
     */
    public function listStudentLessons(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id'
        ]);
        
        $studentId = $request->student_id;
        $authUser = Auth::user();
        
        // Get lessons where:
        // 1. The authenticated user is the coach
        // 2. The specified student is either student1 or student2
        $lessons = Lesson::where('coach_id', $authUser->id)
            ->where(function ($query) use ($studentId) {
                $query->where('student1_id', $studentId)
                      ->orWhere('student2_id', $studentId);
            })
            ->with(['student1', 'student2', 'coach'])
            ->orderBy('lesson_date', 'desc')
            ->get();

        // Add S3 URLs for videos if they exist
        foreach ($lessons as $lesson) {
            if ($lesson->video) {
                $lesson->video = $this->getS3Url($lesson->video);
            }
        }

        return $this->sendResponse($lessons, 'Coach-student lessons retrieved successfully');
    }

    /**
     * Create a new lesson resource.
     */
    public function createLesson(Request $request)
    {
        $authUser = Auth::user();
        
        // Validate the request
        $request->validate([
            'coach_id' => 'required|exists:users,id',
            'student2_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'dance_style' => 'required|string|max:255',
            'dance' => 'required|string|max:255',
            'lesson_date' => 'required|date',
        ]);
        
        // Create new lesson
        $lesson = new Lesson();
        $lesson->student1_id = $authUser->id;
        $lesson->student2_id = $request->student2_id;
        $lesson->coach_id = $request->coach_id;
        $lesson->title = $request->title;
        $lesson->notes = $request->notes;
        $lesson->dance_style = $request->dance_style;
        $lesson->dance = $request->dance;
        $lesson->lesson_date = $request->lesson_date;
        $lesson->save();
        
        // Handle video upload if file is present
        if ($request->hasFile('video')) {
            // Create a new request with the lesson ID
            $videoRequest = new Request();
            $videoRequest->merge(['lesson_id' => $lesson->id]);
            $videoRequest->files->add(['video' => $request->file('video')]);
            
            // Use the existing uploadLessonVideo method
            $response = $this->uploadLessonVideo($videoRequest);
            $responseData = json_decode($response->getContent(), true);
            
            // If video upload failed, return error
            if (!$responseData['success']) {
                return $response;
            }
            
            // Update the lesson with the video URL for response
            $lesson->refresh();
            if ($lesson->video) {
                $lesson->video = $this->getS3Url($lesson->video);
            }
        }
        
        return $this->sendResponse($lesson, 'Lesson created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function getLesson(string $id)
    {
        $authUser = Auth::user();
        $lesson = Lesson::with(['student1', 'student2', 'coach'])->findOrFail($id);
        
        // Check if user is authorized to view this lesson
        if ($lesson->student1_id != $authUser->id && $lesson->student2_id != $authUser->id && $lesson->coach_id != $authUser->id) {
            return $this->sendError('Unauthorized', 'You are not authorized to view this lesson', 403);
        }
        
        // Add S3 URL for video if it exists
        if ($lesson->video) {
            $lesson->video = $this->getS3Url($lesson->video);
        }
        
        return $this->sendResponse($lesson, 'Lesson retrieved successfully');
    }

    /**
     * Update the specified lesson resource.
     */
    public function editLesson(Request $request, string $id)
    {
        $authUser = Auth::user();
        $lesson = Lesson::findOrFail($id);
        
        // Check if user is authorized to edit this lesson
        if ($lesson->student1_id != $authUser->id && $lesson->student2_id != $authUser->id && $lesson->coach_id != $authUser->id) {
            return $this->sendError('Unauthorized', 'You are not authorized to edit this lesson', 403);
        }
        
        // Validate the request
        $request->validate([
            'coach_id' => 'sometimes|exists:users,id',
            'student1_id' => 'sometimes|exists:users,id',
            'student2_id' => 'sometimes|nullable|exists:users,id',
            'title' => 'sometimes|string|max:255',
            'notes' => 'sometimes|nullable|string',
            'dance_style' => 'sometimes|string|max:255',
            'dance' => 'sometimes|string|max:255',
            'lesson_date' => 'sometimes|date',
        ]);
        
        // Handle video upload if file is present
        if ($request->hasFile('video')) {
            // Create a new request with the lesson ID
            $videoRequest = new Request();
            $videoRequest->merge(['lesson_id' => $id]);
            $videoRequest->files->add(['video' => $request->file('video')]);
            
            // Use the existing uploadLessonVideo method
            $response = $this->uploadLessonVideo($videoRequest);
            $responseData = json_decode($response->getContent(), true);
            
            // If video upload failed, return error
            if (!$responseData['success']) {
                return $response;
            }
        }
        
        // Update student fields with authorization rules
        if ($request->has('student1_id') && $authUser->id === $lesson->student2_id) {
            $lesson->student1_id = $request->student1_id;
        } elseif ($request->has('student2_id') && $authUser->id === $lesson->student1_id) {
            $lesson->student2_id = $request->student2_id;
        }
        
        // Update coach_id if present
        if ($request->has('coach_id')) {
            $lesson->coach_id = $request->coach_id;
        }
        
        // Update other fields if present
        if ($request->has('title')) {
            $lesson->title = $request->title;
        }
        
        if ($request->has('notes')) {
            $lesson->notes = $request->notes;
        }
        
        if ($request->has('dance_style')) {
            $lesson->dance_style = $request->dance_style;
        }
        
        if ($request->has('dance')) {
            $lesson->dance = $request->dance;
        }
        
        if ($request->has('lesson_date')) {
            $lesson->lesson_date = $request->lesson_date;
        }
        
        $lesson->save();
        
        // Refresh the lesson to get updated data including video
        $lesson->refresh();
        
        // Add S3 URL for video if it exists
        if ($lesson->video) {
            $lesson->video = $this->getS3Url($lesson->video);
        }
        
        return $this->sendResponse($lesson, 'Lesson updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadLessonVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:102400',
            'lesson_id' => 'required|exists:lessons,id'
        ]);

        if ($request->hasFile('video')) {
            $authUser = Auth::user();
            $lesson = Lesson::findOrFail($request->lesson_id);
            
            // Check if user is authorized to upload to this lesson
            if ($lesson->student1_id != $authUser->id && $lesson->student2_id != $authUser->id && $lesson->coach_id != $authUser->id) {
                return $this->sendError('Unauthorized', 'You are not authorized to upload videos to this lesson', 403);
            }
            
            $extension = request()->file('video')->getClientOriginalExtension();
            $video_name = time() . '_' . $request->lesson_id . '.' . $extension;
            
            $path = $request->file('video')->storeAs(
                'videos',
                $video_name,
                's3'
            );
            
            Storage::disk('s3')->setVisibility($path, "public");
            
            if(!$path) {
                return $this->sendError($path, 'Lesson video failed to upload!');
            }
            
            // Delete old video if exists
            if ($lesson->video) {
                Storage::disk('s3')->delete($lesson->video);
            }
            
            $lesson->video = $path;
            $lesson->save();
            
            $success['video'] = $this->getS3Url($path);
            return $this->sendResponse($success, 'Lesson video uploaded successfully!');
        }
        
        return $this->sendError('Upload failed', 'No video file was provided');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLessonVideo(Request $request, string $id)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:102400',
        ]);

        $authUser = Auth::user();
        $lesson = Lesson::findOrFail($id);
        
        // Check if user is authorized to update this lesson
        if ($lesson->student1_id != $authUser->id && $lesson->student2_id != $authUser->id && $lesson->coach_id != $authUser->id) {
            return $this->sendError('Unauthorized', 'You are not authorized to update videos for this lesson', 403);
        }
        
        if ($request->hasFile('video')) {
            // Delete the old video if exists
            if ($lesson->video) {
                Storage::disk('s3')->delete($lesson->video);
            }
            
            $extension = request()->file('video')->getClientOriginalExtension();
            $video_name = time() . '_' . $id . '.' . $extension;
            
            $path = $request->file('video')->storeAs(
                'videos',
                $video_name,
                's3'
            );
            
            Storage::disk('s3')->setVisibility($path, "public");
            
            if(!$path) {
                return $this->sendError($path, 'Lesson video failed to update!');
            }
            
            $lesson->video = $path;
            $lesson->save();
            
            $success['video'] = $this->getS3Url($path);
            return $this->sendResponse($success, 'Lesson video updated successfully!');
        }
        
        return $this->sendError('Update failed', 'No video file was provided');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteLessonVideo(string $id)
    {
        $authUser = Auth::user();
        $lesson = Lesson::findOrFail($id);
        
        // Check if user is authorized to delete videos from this lesson
        if ($lesson->student1_id != $authUser->id && $lesson->student2_id != $authUser->id && $lesson->coach_id != $authUser->id) {
            return $this->sendError('Unauthorized', 'You are not authorized to delete videos from this lesson', 403);
        }
        
        if ($lesson->video) {
            Storage::disk('s3')->delete($lesson->video);
            $lesson->video = null;
            $lesson->save();
            
            return $this->sendResponse(null, 'Lesson video deleted successfully!');
        }
        
        return $this->sendError('Delete failed', 'No video found for this lesson');
    }

    /**
     * Remove the specified lesson and associated video if present.
     */
    public function deleteLesson(string $id)
    {
        $authUser = Auth::user();
        $lesson = Lesson::findOrFail($id);
        
        // Check if user is authorized to delete this lesson
        if ($lesson->student1_id != $authUser->id && $lesson->student2_id != $authUser->id && $lesson->coach_id != $authUser->id) {
            return $this->sendError('Unauthorized', 'You are not authorized to delete this lesson', 403);
        }
        
        // Delete the video from S3 if it exists
        if ($lesson->video) {
            Storage::disk('s3')->delete($lesson->video);
        }
        
        // Delete the lesson
        $lesson->delete();
        
        return $this->sendResponse(null, 'Lesson deleted successfully');
    }
}
