<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
 
 
Route::get('/', function () {
    return view('profile');
});
 
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [MessageController::class, 'index']);
    Route::get('/messages', [MessageController::class, 'showMessages']);
    Route::get('/profile', [MessageController::class, 'showProfile']);
    Route::get('/sendMessage', [MessageController::class, 'messageForm']);
    Route::post('/sendMessage', [MessageController::class, 'createMessage']);
    Route::post('/answer', [MessageController::class, 'answer']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});