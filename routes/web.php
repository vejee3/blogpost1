<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

// Home page
Route::get('/', function () {
    return redirect()->route('login.form'); // Redirect to the login form
});

// Login
Route::get('/login', [PostController::class, 'loginForm'])->name('login.form');
Route::post('/login', [PostController::class, 'login'])->name('login.submit');

// Registration
Route::get('/register', [PostController::class, 'registerForm'])->name('register.form');
Route::post('/register', [PostController::class, 'register'])->name('register.submit');

// Protected area
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [PostController::class, 'logout'])->name('logout');
});

// Admin area (requires admin middleware)
Route::get('/admin', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard'); // No middleware applied

// Define a route for the index view
Route::get('/index', [PostController::class, 'index'])->name('index'); // Ensure this route is defined

Route::post('/posts', [PostController::class, 'store'])->name('post.store'); // Ensure this route is defined

Route::get('/create', [PostController::class, 'create'])->name('post.create'); // Ensure this route is defined

Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit'); // Ensure this route is defined

Route::put('/posts/{id}', [PostController::class, 'update'])->name('post.update'); // Define the route for updating posts

// Route for deleting the cover image
Route::delete('/deletecover/{id}', [PostController::class, 'deleteCover'])->name('cover.delete');

// Route for deleting additional images
Route::delete('/deleteimage/{id}', [PostController::class, 'deleteImage'])->name('image.delete');

// Admin dashboard route
Route::middleware(['web'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approvePost'])->name('admin.approve');
});

Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
