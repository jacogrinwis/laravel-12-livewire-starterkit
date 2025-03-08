<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::view('posts', 'posts')
//     ->middleware(['auth', 'verified'])
//     ->name('posts');

Volt::route('posts', 'posts')
    ->middleware(['auth', 'verified'])
    ->name('posts');

Volt::route('shipping-zones', 'shipping-zones')
    ->middleware(['auth', 'verified'])
    ->name('shipping-zones');

Volt::route('shipping-carriers', 'shipping-carriers')
    ->middleware(['auth', 'verified'])
    ->name('shipping-carriers');

Volt::route('shipping-methods', 'shipping-methods')
    ->middleware(['auth', 'verified'])
    ->name('shipping-methods');

Volt::route('shipping-methods-radio-cards', 'shipping-methods-radio-cards')
    ->middleware(['auth', 'verified'])
    ->name('shipping-methods-radio-cards');

Volt::route('shipping-options', 'shipping-options')
    ->middleware(['auth', 'verified'])
    ->name('shipping-options');

Volt::route('shipping-calculator', 'shipping-calculator')
    ->middleware(['auth', 'verified'])
    ->name('shipping-calculator');



Volt::route('zones', 'zones')
    ->middleware(['auth', 'verified'])
    ->name('zones');

Volt::route('carriers', 'carriers')
    ->middleware(['auth', 'verified'])
    ->name('carriers');

Volt::route('methods', 'methods')
    ->middleware(['auth', 'verified'])
    ->name('methods');



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Route::get('/counter', \App\Livewire\Counter::class)->name('counter');

require __DIR__.'/auth.php';
