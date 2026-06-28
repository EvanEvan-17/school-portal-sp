<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::dashboard')->name('dashboard');
Route::middleware('guest')->group(function()
{
    Route::livewire('/login', 'pages::auth.login')->name('login');
});
Route::middleware('auth')->group(function()
{
    Route::livewire('/events', 'pages::event')->name('events');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::livewire('/ai-assistant', 'pages::ai-assistant')->name('ai-assistant');
});