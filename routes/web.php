<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('backend/dashboard');
    })->name('dashboard');


    // Activity Log Routes 
    Route::get('/load-content/activities', [ActivityLogController::class, 'showLogs'])->name('activities');


    // Article Routes
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::post('articles/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('articles/dataTablesForArticles', [ArticleController::class, 'dataTablesForArticles'])->name('articles.dataTablesForArticles');
    // Route::resource('articles', ArticleController::class);
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::get('/articles/addArticles', [ArticleController::class, 'addArticles'])->name('articles.add');
    Route::put('/articles/{id}/update', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}/delete', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/{id}/show', [ArticleController::class, 'show'])->name('articles.show');


    // Doctor Routes
    Route::get('doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::post('doctors/store', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('doctors/dataTablesForDoctors', [DoctorController::class, 'dataTablesForDoctors'])->name('doctors.dataTablesForDoctors');
    // Route::resource('doctors', DoctorController::class);
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::get('/doctors/addDoctors', [DoctorController::class, 'addDoctors'])->name('doctors.add');
    Route::put('/doctors/{id}/update', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{id}/delete', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/doctors/{id}/show', [DoctorController::class, 'show'])->name('doctors.show');
    Route::post('/doctors/{id}/toggle-frontpage', [DoctorController::class, 'toggleFrontpage'])->name('doctors.toggleFrontpage');


    // Department Routes
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('departments/dataTablesForDepartments', [DepartmentController::class, 'dataTablesForDepartments'])->name('departments.dataTablesForDepartments');
    // Route::resource('departments', DepartmentController::class);
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::get('/departments/addDepartments', [DepartmentController::class, 'addDepartments'])->name('departments.add');
    Route::put('/departments/{id}/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}/delete', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::get('/departments/{id}/show', [DepartmentController::class, 'show'])->name('departments.show');
    // Route::get('/departments', [DepartmentController::class, 'getDepartment']);
});
Route::get('/home', [FrontEndController::class, 'home'])->name('home');
Route::get('/articleDetails/{surl}', [FrontEndController::class, 'articleDetails'])->name('articleDetails');
Route::get('/about', [FrontEndController::class, 'about'])->name('about');
