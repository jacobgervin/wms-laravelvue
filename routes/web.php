<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WarehouseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// List all warehouse items
Route::get('/warehouse', [WarehouseController::class, 'index']);

// Show the form to create a new warehouse item
Route::get('/warehouse/create', [WarehouseController::class, 'create']);

// Store a new warehouse item
Route::post('/warehouse', [WarehouseController::class, 'store']);

// Show a specific warehouse item
Route::get('/warehouse/{id}', [WarehouseController::class, 'show']);

// Show the form to edit a warehouse item
Route::get('/warehouse/{id}/edit', [WarehouseController::class, 'edit']);

// Update a warehouse item
Route::put('/warehouse/{id}', [WarehouseController::class, 'update']);

// Delete a warehouse item
Route::delete('/warehouse/{id}', [WarehouseController::class, 'destroy']);

