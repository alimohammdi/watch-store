<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Panel\Admin\Roles;
use App\Livewire\Panel\Admin\User;
use App\Livewire\Panel\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::middleware('auth')->group(function () {
 Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');
 Route::get('/users', User::class)->name('users');
 Route::get('/roles/{user}',Roles::class)->name('user.role');
});

require __DIR__.'/auth.php';
