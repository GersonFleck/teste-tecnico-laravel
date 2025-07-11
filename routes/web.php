<?php
use App\Http\Controllers\NbaController;

Route::get('/nba', [NbaController::class, 'index'])->name('nba.index');