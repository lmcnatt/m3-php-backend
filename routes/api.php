<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LessonController;

Route::controller(RegisterController::class)->group(function(): void{
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('forgot_password', 'forgotPassword');
    Route::get('password_reset', 'passwordReset');
    Route::post('password_reset', 'passwordReset');
    Route::post('verify_email', 'verifyEmail');
});

Route::middleware('auth:sanctum')->group(function(): void{
    Route::controller(UserController::class)->group(function(): void{
        Route::get('user', 'getUser');
        Route::post('user/upload_avatar', 'uploadAvatar');
        Route::delete('user/remove_avatar', 'removeAvatar');
        Route::post('user/send_verification_email', 'sendVerificationEmail');
        Route::post('user/change_email', 'changeEmail');
    });

    Route::resource('lessons', LessonController::class);
    Route::controller(LessonController::class)->group(function(): void {
        Route::get('lessons', 'listMyLessons');
        Route::get('lessons/{id}', 'getLesson');
        Route::post('lessons', 'createLesson');
        Route::post('lessons/upload_video', 'uploadLessonVideo');
        Route::put('lessons/{id}', 'updateLessonVideo');
        Route::delete('lessons/{id}', 'deleteLessonVideo');
        Route::delete('lessons/{id}', 'deleteLesson');
    });
});
