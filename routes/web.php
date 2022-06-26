<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Settings\AccountController;
use App\Http\Controllers\Settings\ProfileController;
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

        Route::get('/settings/profile', [ProfileController::class, 'edit'])->name('settings.profile.edit');
        Route::put('/settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
    });
});
