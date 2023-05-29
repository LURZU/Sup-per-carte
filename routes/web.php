<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Card\CardListController;
use App\Http\Controllers\Programme\ProgrammeQuotidienController;
use App\Http\Controllers\User\Admin\AdminController;
use App\Http\Controllers\User\Admin\ProfilController;
use App\Http\Livewire\DynamicMatiereSelection;
use Livewire\Livewire;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Route for profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Global route for all of user (admin, prof, student)
     Route::get('/card/create', [CardController::class, 'create'])->name('card.create');
     Route::post('/card/create', [CardController::class, 'store'])->name('card.store');
     Route::get('/card', [CardListController::class, 'showAll'])->name('card.index');
     Route::get('/card/{card}/edit', [CardController::class, 'edit'])->name('card.edit');
     Route::post('/card/{card}/edit', [CardController::class, 'update'])->name('card.update');
     Route::get('/card/{card}/del', [CardController::class, 'destroy'])->name('card.del');
     Route::get('/card/private', [CardListController::class, 'showMyCard'])->name('card.private');
     Route::get('/card/fav', [CardListController::class, 'showFavCard'])->name('card.favcard');
     Route::get('/card/list', [CardListController::class, 'showProfCard'])->name('card.profcard');

    //Student interface


    //Prof interface

    //Route for programme (Quizz carte révision)
    Route::get('/programme/select', [ProgrammeQuotidienController::class, 'selectParameters'])->name('programme.select');
    Route::post('/programme/select', [ProgrammeQuotidienController::class, 'startProgram'])->name('programme.start');

    //Admin interface
    Route::get('/admin', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::get('/admin/profil', [ProfilController::class, 'index'])->name('admin.profil.index');
    Route::get('/admin/profil/create', [ProfilController::class, 'create'])->name('admin.profil.create');
    Route::post('/admin/profil/create', [ProfilController::class, 'store'])->name('admin.profil.store');
    Route::get('/admin/profil/{user}/edit', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::post('/admin/profil/{user}/edit', [ProfilController::class, 'update'])->name('admin.profil.update');
    Route::delete('/admin/profil/{user}/del', [ProfilController::class, 'destroy'])->name('admin.profil.destroy');


    //Route for livewire 
});

Route::controller()->group(function () {
    
});

require __DIR__.'/auth.php';
