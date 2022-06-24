<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Settings\AccountController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');

    Route::group(['middleware' => 'password.confirm'], function () {
        Route::get('/settings/account', [AccountController::class, 'index'])->name('settings.account.index');
    });
});
