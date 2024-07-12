<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
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

Route::get('/funnels', [FunnelController::class, 'index'])->name('funnels.index');
Route::post('/funnels', [FunnelController::class, 'store'])->name('funnels.store');
Route::get('/funnels/{id}', [FunnelController::class, 'show'])->name('funnels.show');
Route::put('/funnels/{id}', [FunnelController::class, 'update'])->name('funnels.update');
Route::delete('/funnels/{id}', [FunnelController::class, 'destroy'])->name('funnels.destroy');

//AuthCrontroller
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
