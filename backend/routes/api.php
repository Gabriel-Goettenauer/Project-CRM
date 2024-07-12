<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/funnels', [FunnelController::class, 'index'])->name('funnels.index');
Route::post('/funnels', [FunnelController::class, 'store'])->name('funnels.store');
Route::get('/funnels/{id}', [FunnelController::class, 'show'])->name('funnels.show');
Route::put('/funnels/{id}', [FunnelController::class, 'update'])->name('funnels.update');
Route::delete('/funnels/{id}', [FunnelController::class, 'destroy'])->name('funnels.destroy');
Route::get('/funnels/{id}/details', [FunnelController::class, 'showFunnelDetails']);
