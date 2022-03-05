<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\CustomerController;

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

// Welcome
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    // App
    // Route::resource('/books', BookController::class);
    // Route::resource('/books/{book}/customers', CustomerController::class);
    // Route::resource('/books/{book}/customers/{customer}/entries', EntryController::class);
});

require_once __DIR__ . '/jetstream.php';
