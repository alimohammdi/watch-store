<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Panel\Admin\User;
use App\Livewire\Panel\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});


Route::middleware('auth')->group(function () {

 Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');
 Route::get('/users', User::class);
});

require __DIR__.'/auth.php';
