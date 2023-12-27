<?php

use App\Http\Controllers\API\V2\AuthController;
use App\Http\Controllers\API\V2\CategoryController;
use App\Http\Controllers\API\V2\CourseController;
use App\Http\Controllers\API\V2\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v2/register', [AuthController::class, 'register']);
Route::post('/v2/login', [AuthController::class, 'login']);
// auth check
Route::get('/v2/auth-check', [AuthController::class, 'auth_check']);

/**
 * CATEGORY
 */
Route::get('/v2/top_categories', [CategoryController::class, 'top_categories']);

/**
 * COURSE
 */
Route::get('/v2/top_courses', [CourseController::class, 'top_course']);
Route::get('/v2/discount_courses', [CourseController::class, 'discount_courses']);
Route::get('/v2/course/{slug}', [CourseController::class, 'single_course']);

/**
 * FRONTEND
 */
Route::get('/v2/slider', [FrontendController::class, 'slider']);
Route::get('/v2/counting_data', [FrontendController::class, 'counting_data']);
Route::get('/v2/top_instructor', [FrontendController::class, 'top_instructor']);
