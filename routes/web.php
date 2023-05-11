<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Student\DeckCardStudentController;
use App\Http\Controllers\Student\FavCardController;
use App\Http\Controllers\Card\CardListController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route for student
    Route::get('/card/create', [CardController::class, 'create'])->name('card.create');
    Route::post('/card/create', [CardController::class, 'store'])->name('card.store');
    Route::get('/card', [CardController::class, 'showAll'])->name('card.index');
    Route::get('/card/{card}/edit', [CardController::class, 'edit'])->name('card.edit');
    Route::post('/card/{card}/edit', [CardController::class, 'update'])->name('card.update');
    Route::get('/card/{card}/del', [CardController::class, 'destroy'])->name('card.del');
    Route::get('/card/private', [CardListController::class, 'showMyCard'])->name('card.index');
    Route::get('/card/fav', [CardController::class, 'showAll'])->name('card.index');
    Route::get('/quizz', [CardController::class, 'showAll'])->name('card.index');
});

Route::controller()->group(function () {
    
});

require __DIR__.'/auth.php';
