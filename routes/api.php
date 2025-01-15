<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\VideoController;
use App\Models\Kuis;
use App\Http\Controllers\JawabanUserController;
use App\Http\Controllers\KunciJawabanController;

Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);

Route::middleware(['auth:sanctum'])->get('profile', [ApiController::class, 'profile']);
Route::middleware(['auth:sanctum'])->get('logout', [ApiController::class, 'logout']);

Route::middleware(['auth:sanctum'])->get('kuis', [KuisController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('kuis', [KuisController::class, 'kuis']);
Route::middleware(['auth:sanctum'])->get('kuis/{id}', [KuisController::class, 'show']);
Route::middleware(['auth:sanctum'])->put('kuisupdate/{id}', [KuisController::class, 'update']);
Route::middleware(['auth:sanctum'])->delete('kuisdelete/{id}', [KuisController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->get('video', [VideoController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('video', [VideoController::class, 'video']);
Route::middleware(['auth:sanctum'])->get('video/{id}', [VideoController::class, 'show']);
Route::middleware(['auth:sanctum'])->put('videoupdate/{id}', [VideoController::class, 'update']);
Route::middleware(['auth:sanctum'])->delete('videodelete/{id}', [VideoController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->get('feedback', [FeedbackController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('feedback', [FeedbackController::class, 'feedback']);

Route::middleware(['auth:sanctum'])->post('jawaban-user', [JawabanUserController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('kunci-jawaban', [KunciJawabanController::class, 'store']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
