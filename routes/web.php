<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PilotoController;
use App\Http\Controllers\EquipeController;

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('/', [NoticiaController::class, 'home'])->name('home');
Route::resource('noticias', NoticiaController::class);


Route::get('/dashboard', [NoticiaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/search', [NoticiaController::class, 'search'])->name('search');
Route::get('/pilotos/search', [PilotoController::class, 'search'])->name('pilotos.search');
Route::get('/equipes/search', [EquipeController::class, 'search'])->name('equipes.search');
Route::get('/pilotos/listar', [PilotoController::class, 'listar'])->name('pilotos.listar');
Route::get('/equipes/listar', [EquipeController::class, 'listar'])->name('equipes.listar');
Route::resource('pilotos', App\Http\Controllers\PilotoController::class);
Route::resource('equipes', App\Http\Controllers\EquipeController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
