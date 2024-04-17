<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DealerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentCourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Dealer routes
Route::get('/dealers', [DealerController::class,'index']);
Route::post('/dealers', [DealerController::class, 'store']);
Route::get('/dealers/{id}', [DealerController::class, 'show']);
Route::put('/dealers/{id}', [DealerController::class, 'update']);
Route::delete('/dealers/{id}', [DealerController::class, 'destroy']);

// Brand routes
Route::get('/brands', [BrandController::class, 'index']);
Route::post('/brands', [BrandController::class, 'store']);
Route::get('/brands/{id}', [BrandController::class, 'show']);
Route::put('/brands/{id}', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'destroy']);


//Author routes
Route::post('/authors', [AuthorController::class,'store']);
Route::get('/authors', [AuthorController::class,'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::put('/authors/{id}', [AuthorController::class, 'update']);
Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);


//Book routes
Route::post('/books', [BookController::class,'store']);
Route::get('/books', [BookController::class,'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);


//Student  routes
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);

//Course routes
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

//pivot table 
Route::post('/assign-course-to-student', [StudentCourseController::class, 'assignCourseToStudent']);
Route::get('count', [StudentCourseController::class,'count']);


Route::post('/students/{studentId}/attach-courses', [StudentController::class, 'attachCourses']);
Route::post('/students/{studentId}/detachCourses', [StudentController::class, 'detachCourses']);

