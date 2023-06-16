<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController,
    ReplySupportController,
    SupportController,

};
use App\Http\Controllers\Api\Auth\AuthController;

Route::post('/auth', [AuthController::class,'auth']);
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class,'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/courses', [CourseController::class,'index']);
    Route::get('/courses/{id}', [CourseController::class,'show']);
    Route::get('/courses/{id}/modules', [ModuleController::class,'index']);
    Route::get('/modules/{id}/lessons', [LessonController::class,'index']);
    Route::get('/lessons/{id}', [LessonController::class,'show']);
    Route::get('/supports', [SupportController::class,'index']);
    Route::get('/my-supports', [SupportController::class,'mySupports']);
    Route::post('/supports', [SupportController::class,'store']);
    Route::post('/replies', [ReplySupportController::class,'createReply']);

});



Route::get('/', function(){
    return response()->json([
        'success' => true,
    ]);
});
