<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\CardController;
use App\Http\Controllers\Student\DeckCardStudentController;
use App\Http\Controllers\Student\FavCardController;

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
    Route::get('/card', [CardController::class, 'showAll'])->name('card.index');
    Route::get('/card/fav', [CardController::class, 'index'])->name('card.index');
    Route::get('/quizz', [CardController::class, 'index'])->name('card.index');
    Route::get('/card/create', [CardController::class, 'create'])->name('card.create');
    Route::post('/card/create', [CardController::class, 'store'])->name('card.create');

});

Route::controller()->group(function () {
    
});

require __DIR__.'/auth.php';
