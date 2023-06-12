<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Card\CardListController;
use App\Http\Controllers\Programme\ProgrammeQuotidienController;
use App\Http\Controllers\User\Admin\AdminController;
use App\Http\Controllers\User\Admin\FormationController;
use App\Http\Controllers\User\Admin\ChapitreController;
use App\Http\Controllers\User\Admin\ProfilController;
use App\Http\Controllers\User\Admin\MatiereController;
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
    if(auth()->user()){
        if(auth()->user()->hasRole('etudiant')) {
            return redirect()->route('student.index');
        }
        return redirect()->route('dashboard');
    }
   
    return redirect()->route('login');
});

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //Route for profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //parameters (Student, enseignant, admin)
    Route::get('/parameters', [ProfileController::class, 'parameters'])->name('parameters');

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
    Route::get('/accueil', [App\Http\Controllers\User\Student\StudentController::class, 'index'])->name('student.index');
    Route::get('/stats', [App\Http\Controllers\User\Student\StatController::class, 'index'])->name('stats.index');

    //Prof interface
    Route::get('/prof/chapitre/', [App\Http\Controllers\User\Prof\ChapitreController::class, 'index'])->name('prof.chapitre.index');

    //Route for programme (Quizz carte révision)
    Route::get('/programme/select', [ProgrammeQuotidienController::class, 'selectParameters'])->name('programme.select');
    Route::post('/programme/select', [ProgrammeQuotidienController::class, 'startProgram'])->name('programme.start');
    Route::get('/programme/mycard/select', [ProgrammeQuotidienController::class, 'selectParameters'])->name('programme.mycard.select');
    Route::post('/programme/mycard/select', [ProgrammeQuotidienController::class, 'startProgram'])->name('programme.mycard.start');
    Route::get('/programme/unmastered', [ProgrammeQuotidienController::class, 'randomCard'])->name('programme.unmastered.start');
    Route::post('/programme/unmastered', [ProgrammeQuotidienController::class, 'randomCard'])->name('programme.unmastered.start');

    //Admin interface
    Route::get('/admin', function () { return view('dashboard');  })->name('admin.dashboard');
    Route::get('/admin/profil', [ProfilController::class, 'index'])->name('admin.profil.index');
    Route::get('/admin/profil/create', [ProfilController::class, 'create'])->name('admin.profil.create');
    Route::post('/admin/profil/create', [ProfilController::class, 'store'])->name('admin.profil.store');
    Route::get('/admin/profil/{user}/edit', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::post('/admin/profil/{user}/edit', [ProfilController::class, 'update'])->name('admin.profil.update');
    Route::delete('/admin/profil/{user}/del', [ProfilController::class, 'destroy'])->name('admin.profil.destroy');

    Route::get('/admin/formation', [FormationController::class, 'index'])->name('admin.formation.index');

    Route::get('/admin/matiere', [MatiereController::class, 'index'])->name('admin.matiere.index');
    Route::get('/admin/matiere/create', [MatiereController::class, 'create'])->name('admin.matiere.create');
    Route::post('/admin/matiere/create', [MatiereController::class, 'store'])->name('admin.matiere.store');
    Route::get('/admin/matiere/{matiere}/edit', [MatiereController::class, 'edit'])->name('admin.matiere.edit');
    Route::post('/admin/matiere/{matiere}/edit', [MatiereController::class, 'update'])->name('admin.matiere.update');
    Route::delete('/admin/matiere/{matiere}/del', [MatiereController::class, 'destroy'])->name('admin.matiere.destroy');

    //Route for livewire 
});


require __DIR__.'/auth.php';
