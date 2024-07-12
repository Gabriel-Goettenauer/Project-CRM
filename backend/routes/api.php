<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FunnelController; 
use App\Http\Controllers\AuthController; 


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/funnels', [FunnelController::class, 'index'])->name('funnels.index');
Route::post('/funnels', [FunnelController::class, 'store'])->name('funnels.store');
Route::get('/funnels/{id}', [FunnelController::class, 'show'])->name('funnels.show');
Route::put('/funnels/{id}', [FunnelController::class, 'update'])->name('funnels.update');
Route::delete('/funnels/{id}', [FunnelController::class, 'destroy'])->name('funnels.destroy');

Route::get('/funnels/{id}/details', [FunnelController::class, 'showFunnelDetails']);


//AuthCrontroller
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.email');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');
