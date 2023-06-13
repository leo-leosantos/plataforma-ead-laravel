<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
};



Route::get('/courses', [CourseController::class,'index']);
Route::get('/courses/{id}', [CourseController::class,'show']);
Route::get('/courses/{id}/modules', [ModuleController::class,'index']);

Route::get('/', function(){
    return response()->json([
        'success' => true,
    ]);
});
