<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FunnelController; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ContactController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Funnels
Route::get('/funnels', [FunnelController::class, 'index'])->name('funnels.index');
Route::post('/funnels', [FunnelController::class, 'store'])->name('funnels.store');
Route::get('/funnels/{id}', [FunnelController::class, 'show'])->name('funnels.show');
Route::put('/funnels/{id}', [FunnelController::class, 'update'])->name('funnels.update');
Route::delete('/funnels/{id}', [FunnelController::class, 'destroy'])->name('funnels.destroy');
Route::get('/funnels/{id}/details', [FunnelController::class, 'showFunnelDetails']);


//AuthCrontroller
Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');


//Contacts
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');