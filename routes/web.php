<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SocialmediaController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\InsuranceController;
use Illuminate\Support\Facades\Route;

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend/dashboard');
    })->name('dashboard');


    // Activity Log Routes 
    Route::get('/load-content/activities', [ActivityLogController::class, 'showLogs'])->name('activities');


    // Article Routes
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/dataTablesForArticles', [ArticleController::class, 'dataTablesForArticles'])->name('articles.dataTablesForArticles');
    // Route::resource('articles', ArticleController::class);
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::get('/articles/addArticles', [ArticleController::class, 'addArticles'])->name('articles.add');
    Route::put('/articles/{id}/update', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}/delete', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/{id}/show', [ArticleController::class, 'show'])->name('articles.show');


    // Doctor Routes
    Route::get('/admin_doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::post('/doctors/store', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/dataTablesForDoctors', [DoctorController::class, 'dataTablesForDoctors'])->name('doctors.dataTablesForDoctors');
    Route::post('/doctors/increment', [DoctorController::class, 'doctorIncrement'])->name('doctors.increment');
    Route::post('/doctors/decrement', [DoctorController::class, 'doctorDecrement'])->name('doctors.decrement');
    // Route::resource('doctors', DoctorController::class);
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::get('/doctors/addDoctors', [DoctorController::class, 'addDoctors'])->name('doctors.add');
    Route::put('/doctors/{id}/update', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{id}/delete', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/doctors/{id}/show', [DoctorController::class, 'show'])->name('doctors.show');
    Route::post('/doctors/{id}/toggle-frontpage', [DoctorController::class, 'toggleFrontpage'])->name('doctors.toggleFrontpage');


    // Department Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/dataTablesForDepartments', [DepartmentController::class, 'dataTablesForDepartments'])->name('departments.dataTablesForDepartments');
    Route::post('/departments/increment', [DepartmentController::class, 'departmentIncrement'])->name('departments.increment');
    Route::post('/departments/decrement', [DepartmentController::class, 'departmentDecrement'])->name('departments.decrement');
    // Route::resource('departments', DepartmentController::class);
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::get('/departments/addDepartments', [DepartmentController::class, 'addDepartments'])->name('departments.add');
    Route::put('/departments/{id}/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}/delete', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::get('/departments/{id}/show', [DepartmentController::class, 'show'])->name('departments.show');
    // Route::get('/departments', [DepartmentController::class, 'getDepartment']);


    // Branch Routes
    Route::get('/branchs', [BranchController::class, 'index'])->name('branchs.index');
    Route::post('/branchs/store', [BranchController::class, 'store'])->name('branchs.store');
    Route::get('/branchs/dataTablesForBranchs', [BranchController::class, 'dataTablesForBranchs'])->name('branchs.dataTablesForBranchs');
    Route::post('/branchs/increment', [BranchController::class, 'branchIncrement'])->name('branchs.increment');
    Route::post('/branchs/decrement', [BranchController::class, 'branchDecrement'])->name('branchs.decrement');
    // Route::resource('branchs', BranchController::class);
    Route::get('/branchs/{id}/edit', [BranchController::class, 'edit'])->name('branchs.edit');
    Route::get('/branchs/addBranchs', [BranchController::class, 'addBranchs'])->name('branchs.add');
    Route::put('/branchs/{id}/update', [BranchController::class, 'update'])->name('branchs.update');
    Route::delete('/branchs/{id}/delete', [BranchController::class, 'destroy'])->name('branchs.destroy');
    Route::get('/branchs/{id}/show', [BranchController::class, 'show'])->name('branchs.show');
    // Route::get('/branchs', [BranchController::class, 'getBranch']);


    // Offer Routes
    Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
    Route::post('/offers/store', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/offers/dataTablesForOffers', [OfferController::class, 'dataTablesForOffers'])->name('offers.dataTablesForOffers');
    Route::post('/offers/increment', [OfferController::class, 'offerIncrement'])->name('offers.increment');
    Route::post('/offers/decrement', [OfferController::class, 'offerDecrement'])->name('offers.decrement');
    // Route::resource('offers', OfferController::class);
    Route::get('/offers/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::get('/offers/addOffers', [OfferController::class, 'addOffers'])->name('offers.add');
    Route::put('/offers/update', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/offers/{id}/delete', [OfferController::class, 'destroy'])->name('offers.destroy');
    Route::get('/offers/{id}/show', [OfferController::class, 'show'])->name('offers.show');
    // Route::get('/offers', [OfferController::class, 'getOffer']);


    // Socialmedia Routes
    Route::get('/socialmedias', [SocialmediaController::class, 'index'])->name('socialmedias.index');
    Route::post('/socialmedias/store', [SocialmediaController::class, 'store'])->name('socialmedias.store');
    Route::get('/socialmedias/dataTablesForSocialmedias', [SocialmediaController::class, 'dataTablesForSocialmedias'])->name('socialmedias.dataTablesForSocialmedias');
    Route::post('/socialmedias/increment', [SocialmediaController::class, 'socialmediaIncrement'])->name('socialmedias.increment');
    Route::post('/socialmedias/decrement', [SocialmediaController::class, 'socialmediaDecrement'])->name('socialmedias.decrement');
    // Route::resource('socialmedias', SocialmediaController::class);
    Route::get('/socialmedias/{id}/edit', [SocialmediaController::class, 'edit'])->name('socialmedias.edit');
    Route::get('/socialmedias/addSocialmedias', [SocialmediaController::class, 'addSocialmedias'])->name('socialmedias.add');
    Route::put('/socialmedias/update', [SocialmediaController::class, 'update'])->name('socialmedias.update');
    Route::delete('/socialmedias/{id}/delete', [SocialmediaController::class, 'destroy'])->name('socialmedias.destroy');
    Route::get('/socialmedias/{id}/show', [SocialmediaController::class, 'show'])->name('socialmedias.show');
    // Route::get('/socialmedias', [SocialmediaController::class, 'getSocialmedia']);


    // Partner Routes
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::post('/partners/store', [PartnerController::class, 'store'])->name('partners.store');
    Route::get('/partners/dataTablesForPartners', [PartnerController::class, 'dataTablesForPartners'])->name('partners.dataTablesForPartners');
    Route::post('/partners/increment', [PartnerController::class, 'partnerIncrement'])->name('partners.increment');
    Route::post('/partners/decrement', [PartnerController::class, 'partnerDecrement'])->name('partners.decrement');
    // Route::resource('partners', PartnerController::class);
    Route::get('/partners/{id}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::get('/partners/addPartners', [PartnerController::class, 'addPartners'])->name('partners.add');
    Route::put('/partners/update', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{id}/delete', [PartnerController::class, 'destroy'])->name('partners.destroy');
    Route::get('/partners/{id}/show', [PartnerController::class, 'show'])->name('partners.show');
    // Route::get('/partners', [PartnerController::class, 'getPartner']);


    // Insurance Routes
    Route::get('/insurances', [InsuranceController::class, 'index'])->name('insurances.index');
    Route::post('/insurances/store', [InsuranceController::class, 'store'])->name('insurances.store');
    Route::get('/insurances/dataTablesForInsurances', [InsuranceController::class, 'dataTablesForInsurances'])->name('insurances.dataTablesForInsurances');
    Route::post('/insurances/increment', [InsuranceController::class, 'insuranceIncrement'])->name('insurances.increment');
    Route::post('/insurances/decrement', [InsuranceController::class, 'insuranceDecrement'])->name('insurances.decrement');
    // Route::resource('insurances', InsuranceController::class);
    Route::get('/insurances/{id}/edit', [InsuranceController::class, 'edit'])->name('insurances.edit');
    Route::get('/insurances/addInsurances', [InsuranceController::class, 'addInsurances'])->name('insurances.add');
    Route::put('/insurances/update', [InsuranceController::class, 'update'])->name('insurances.update');
    Route::delete('/insurances/{id}/delete', [InsuranceController::class, 'destroy'])->name('insurances.destroy');
    Route::get('/insurances/{id}/show', [InsuranceController::class, 'show'])->name('insurances.show');
    // Route::get('/insurances', [InsuranceController::class, 'getInsurance']);
});
Route::get('/', [FrontEndController::class, 'home']);
Route::get('/home', [FrontEndController::class, 'home'])->name('home');
Route::get('/articleDetails/{surl}', [FrontEndController::class, 'articleDetails'])->name('articleDetails');
Route::get('/about', [FrontEndController::class, 'about'])->name('about');
Route::get('/main_offers', [FrontEndController::class, 'offer'])->name('offer');
Route::get('/contact_us', [FrontEndController::class, 'contact_us'])->name('contact_us');
Route::get('/doctors', [FrontEndController::class, 'doctors'])->name('doctors');
Route::get('/branch_location/{clinicId}', [FrontEndController::class, 'branch_location'])->name('branch_location');
Route::get('/departmentDetails/{surl}', [FrontEndController::class, 'departmentDetails'])->name('departmentDetails');
Route::get('/privacy_policy', [FrontEndController::class, 'privacy_policy'])->name('privacy_policy');

