<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// All routes inside this group require the user to be logged in
Route::middleware('auth')->group(function () {
    
    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post CRUD Routes
    // Using 'resource' automatically creates:
    // GET /posts (index)
    // GET /posts/create (create)
    // POST /posts (store)
    // GET /posts/{post}/edit (edit)
    // PUT /posts/{post} (update)
    // DELETE /posts/{post} (destroy)
    Route::resource('posts', PostController::class);
    
});

require __DIR__.'/auth.php';