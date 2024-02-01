<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoadtripController;
use App\Models\User;
use App\Models\Roadtrip;



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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    //      PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //      ROADTRIP ROUTES
    Route::get('/roadtrip', [RoadtripController::class, 'index'])->name('roadtrip.index');
    Route::get('/roadtrip/create', [RoadtripController::class, 'create'])->name('roadtrip.create');
    Route::post('/roadtrip/store', [RoadtripController::class, 'store'])->name('roadtrip.store');
    Route::get('/roadtrip/delete', [RoadtripController::class, 'show'])->name('roadtrip.show');
    Route::get('/roadtrip/delete', [RoadtripController::class, 'delete'])->name('roadtrip.delete');

});

require __DIR__.'/auth.php';
