<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecommendedJobController;
Route::get('/test', function() {
    return response()->json(['message' => 'API route works']);
});
Route::get('/jobs', [RecommendedJobController::class, 'index']);
Route::post('/jobs', [RecommendedJobController::class, 'store']);
Route::get('/jobs/{id}', [RecommendedJobController::class, 'show']);
Route::put('/jobs/{id}', [RecommendedJobController::class, 'update']);
Route::delete('/jobs/{id}', [RecommendedJobController::class, 'destroy']);
