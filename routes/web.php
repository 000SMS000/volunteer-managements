<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\ManageTasks;
use App\Livewire\ManageWorkplaces;
use App\Livewire\ManageVolunteers;
use App\Livewire\AssignVolunteer;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::get('/workplaces', ManageWorkplaces::class)->name('workplaces.manage');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/tasks',    ManageTasks::class)->name('tasks.manage');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/volunteers', ManageVolunteers::class)->name('volunteers.manage');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/assign', AssignVolunteer::class)->name('assign.volunteer');
});
