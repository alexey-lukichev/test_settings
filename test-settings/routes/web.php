<?php

use App\Http\Controllers\SettingsChangeController;
use Illuminate\Support\Facades\Route;

Route::post('/settings/change', [SettingsChangeController::class, 'requestChange']);
Route::post('/settings/confirm', [SettingsChangeController::class, 'confirmChange']);
