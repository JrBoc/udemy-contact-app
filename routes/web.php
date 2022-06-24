<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Settings\AccountController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resources([
        '/contacts' => ContactController::class,
        '/companies' => CompanyController::class,
    ]);

    Route::group(['middleware' => 'password.confirm'], function () {
        Route::get('/settings/account', [AccountController::class, 'index'])->name('settings.account.index');
    });
});
