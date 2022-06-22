<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', function () {
    return '<h1>All Contacts</h1>';
})->name('contacts.index');

Route::get('/contacts/create', function() {
   return '<h1>Add New Contact</h1>';
})->name('contacts.create');

Route::get('/contacts/{id}', function($id) {
    return \App\Models\Contact::find($id);
})->name('contacts.show');
