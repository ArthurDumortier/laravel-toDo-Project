<?php

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('accueilConnectionView'); });
Route::get('/Connection', [ConnectionController::class, 'Connection'])->name('Connection');
Route::get('/Inscription', [InscriptionController::class, 'Inscription'])->name('Inscription');
Route::get('/verifConnection', [ConnectionController::class, 'VerifConnection'])->name('verifConnection');
Route::get('/add', [InscriptionController::class,"AddUser"])->name('addUser');

Route::middleware(['connected'])->group(function() {
Route::get('/TachesAccueil/{id}', [TacheController::class, 'GetTaches'])->name('TachesAccueil');
Route::get('/TachesFini/{id}', [TacheController::class, 'GetTachesFini'])->name('TacheFinis');
Route::get('/CreateTaches/{id}', [TacheController::class, 'CreateTaches'])->name('CreateTaches');
Route::get('/AddTache/{id}', [TacheController::class, 'AddTache'])->name('AddTache');
Route::get('/CloseTache/{idTache}', [TacheController::class, 'CloseTache'])->name('CloseTache');
Route::get('/GoToEditTache/{idTache}', [TacheController::class, 'GoToEditTache'])->name('GoToEditTache');
Route::get('/EditTache/{idTache}', [TacheController::class, 'EditTache'])->name('EditTache');
// Route::get('/SearchTache/{id}', [TacheController::class, 'SearchTache'])->name('searchTache');
// Route::get('/SearchTacheFini/{id}', [TacheController::class, 'SearchTacheFini'])->name('searchTacheFini');
Route::get('/logout', [ConnectionController::class, 'logout'])->name('logout');
});
