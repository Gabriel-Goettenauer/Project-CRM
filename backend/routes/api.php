<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FunnelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StageController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Funnels
Route::get('/funnels', [FunnelController::class, 'index']);
Route::post('/funnels', [FunnelController::class, 'store']);
Route::get('/funnels/{id}', [FunnelController::class, 'show']);
Route::put('/funnels/{id}', [FunnelController::class, 'update']);
Route::delete('/funnels/{id}', [FunnelController::class, 'destroy']);
Route::get('/funnels/{id}/details', [FunnelController::class, 'showFunnelDetails']);

// AuthController
Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');

// Contacts
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Route para filtrar contatos por stage_id
Route::get('/contacts/by-stage', [ContactController::class, 'indexByStage'])->name('contacts.indexByStage');

// Stages
Route::get('/stages', [StageController::class, 'index']);
Route::post('/stages', [StageController::class, 'store']);
Route::get('/stages/{id}', [StageController::class, 'show']);
Route::put('/stages/{id}', [StageController::class, 'update']);
Route::delete('/stages/{id}', [StageController::class, 'destroy']);
