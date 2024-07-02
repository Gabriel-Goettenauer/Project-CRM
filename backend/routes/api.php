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

use App\Http\Controllers\LoginController;

Route::get('/logins', [LoginController::class, 'index'])->name('logins.index');
Route::post('/logins/create', [LoginController::class, 'create'])->name('logins.create');
Route::post('/register', [LoginController::class, 'store'])->name('logins.store');
Route::get('/logins/{id}', [LoginController::class, 'show'])->name('logins.show');
Route::get('/logins/{id}/edit', [LoginController::class, 'edit'])->name('logins.edit');
Route::put('/logins/{id}', [LoginController::class, 'update'])->name('logins.update');
Route::delete('/logins/{id}', [LoginController::class, 'destroy'])->name('logins.destroy');
