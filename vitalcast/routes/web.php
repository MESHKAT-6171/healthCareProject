<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\HealthLogController;
use App\Http\Controllers\InsightController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\AssessmentController;



// Public Welcome Page
Route::get('/', function () { return view('welcome'); });

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Protected Home/Dashboard Route (Only accessible if logged in)
Route::get('/home', function () {
    return view('home');
})->middleware('auth');

// Add this at the bottom
Route::resource('logs', HealthLogController::class);

// Protected Campus Insights Route
Route::get('/insights', [InsightController::class, 'index'])->middleware('auth')->name('insights');

// User Profile Routes
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// Secret Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/export', [AdminController::class, 'exportCsv'])->name('admin.export');
});



Route::get('/assessment', [AssessmentController::class, 'showForm'])->name('assessment.form');
Route::post('/assessment', [AssessmentController::class, 'submitForm'])->name('assessment.submit');