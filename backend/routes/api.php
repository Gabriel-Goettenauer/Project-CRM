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

use App\Http\Controllers\PersonalAccessTokenController;

Route::get('/personal-access-tokens', [PersonalAccessTokenController::class, 'index'])->name('personalAccessTokens.index');
Route::get('/personal-access-tokens/create', [PersonalAccessTokenController::class, 'create'])->name('personalAccessTokens.create');
Route::post('/personal-access-tokens', [PersonalAccessTokenController::class, 'store'])->name('personalAccessTokens.store');
Route::get('/personal-access-tokens/{id}', [PersonalAccessTokenController::class, 'show'])->name('personalAccessTokens.show');
Route::get('/personal-access-tokens/{id}/edit', [PersonalAccessTokenController::class, 'edit'])->name('personalAccessTokens.edit');
Route::put('/personal-access-tokens/{id}', [PersonalAccessTokenController::class, 'update'])->name('personalAccessTokens.update');
Route::delete('/personal-access-tokens/{id}', [PersonalAccessTokenController::class, 'destroy'])->name('personalAccessTokens.destroy');
