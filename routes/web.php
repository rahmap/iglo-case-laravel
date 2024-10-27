<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return redirect()->to(Filament::getHomeUrl());
});

Route::get('/login', function () {
	return redirect()->to(Filament::getLoginUrl());
})->name('login');
