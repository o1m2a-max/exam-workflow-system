<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;

Route::get('/', function () {
    return view('welcome');
});

// VIEW + CREATE
Route::get('/exams', [ExamController::class, 'index']);
Route::post('/exams', [ExamController::class, 'store']);

// ✅ NEW: ARCHIVED PAGE
Route::get('/exams/archived', [ExamController::class, 'archived']);

// STATE ACTIONS
Route::post('/exams/{id}/publish', [ExamController::class, 'publish']);
Route::post('/exams/{id}/start', [ExamController::class, 'start']);
Route::post('/exams/{id}/complete', [ExamController::class, 'complete']);
Route::post('/exams/{id}/archive', [ExamController::class, 'archive']);

// DELETE
Route::delete('/exams/{id}', [ExamController::class, 'destroy']);

// EDIT + UPDATE
Route::get('/exams/{id}/edit', [ExamController::class, 'edit']);
Route::put('/exams/{id}', [ExamController::class, 'update']);
Route::post('/exams/{id}/questions', [ExamController::class, 'addQuestion']);