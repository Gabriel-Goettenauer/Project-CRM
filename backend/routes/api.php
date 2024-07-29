<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FunnelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StageController;

// usuário autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// contatos
Route::middleware('auth:sanctum')->prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'indexByStage'])->name('contacts.index');
    Route::get('/all', [ContactController::class, 'index'])->name('contacts.indexAll');
    Route::post('/', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::put('/{id}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/by-stage', [ContactController::class, 'indexByStage'])->name('contacts.indexByStage');
});

// etapas
Route::middleware('auth:sanctum')->prefix('stages')->group(function () {
    Route::get('/{id}/all', [StageController::class, 'index']);
    Route::post('/', [StageController::class, 'store']);
    Route::get('/{id}', [StageController::class, 'show']);
    Route::put('/{id}', [StageController::class, 'update']);
    Route::delete('/{id}', [StageController::class, 'destroy']);
});

//  funis
Route::middleware('auth:sanctum')->prefix('funnels')->group(function () {
    Route::get('/', [FunnelController::class, 'index']);
    Route::post('/', [FunnelController::class, 'store']);
    Route::get('/{id}', [FunnelController::class, 'show']);
    Route::put('/{id}', [FunnelController::class, 'update']);
    Route::delete('/{id}', [FunnelController::class, 'destroy']);
    Route::get('/{id}/details', [FunnelController::class, 'showFunnelDetails']);
});

// autenticação 
Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
