<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobApplicationDetailController;
use App\Http\Controllers\security\PermissionsController;
use App\Http\Controllers\security\PermissionController;
use App\Http\Controllers\security\RoleController;
use App\Http\Controllers\security\UserController;
use App\Http\Controllers\security\AccountController;
use App\Http\Controllers\CaseManagerController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //security
    Route::resource('permission', PermissionsController::class);
    Route::post('permission/unlink', [PermissionController::class, 'unlink']);
    Route::post('permission/link', [PermissionController::class, 'link']);
    Route::post('role/unlink', [UserController::class, 'unlink']);
    Route::post('role/link', [UserController::class, 'link']);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('account', AccountController::class);
});

//validacion email
Route::get('validate_email/{id}', [RegisteredUserController::class, 'validate_email']);
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('lang/{lang}', [LanguageController::class, 'swap'])->name('lang.swap');

require __DIR__ . '/auth.php';


Route::resource('employer', EmployerController::class);
Route::get('get_naics_code/{id}', [EmployerController::class, 'get_naics_code']);

#counties
Route::get('get_counties/{id}', [EmployerController::class, 'get_counties']);

#counties mailing
Route::get('get_counties_mailing/{id}', [EmployerController::class, 'get_counties_mailing']);

#counties worksite
Route::get('get_counties_worksite/{id}', [EmployerController::class, 'get_counties_worksite']);


#cities
Route::get('get_cities/{id}', [EmployerController::class, 'get_cities']);

#cities mailing
Route::get('get_cities_mailing/{id}', [EmployerController::class, 'get_cities_mailing']);

#cities worksite
Route::get('get_cities_worksite/{id}', [EmployerController::class, 'get_cities_worksite']);

#codes zip
Route::get('get_zipcodes/{id}', [EmployerController::class, 'get_zipcodes']);

#codes zip mailing
Route::get('get_zipcodes_mailing/{id}', [EmployerController::class, 'get_zipcodes_mailing']);

#codes zip worksite
Route::get('get_zipcodes_worksite/{id}', [EmployerController::class, 'get_zipcodes_worksite']);


Route::post('employer_place_of_business', [EmployerController::class, 'employer_place_of_business']);
Route::post('employer_contact_information', [EmployerController::class, 'employer_contact_information']);

Route::post('employer_place_store', [EmployerController::class, 'employer_place_store']);
Route::post('employer_additional_location', [EmployerController::class, 'employer_additional_location']);
Route::post('employer/activate', [EmployerController::class, 'activate']);
Route::get('profile_employer/{id}', [EmployerController::class, 'profile_employer']);


Route::resource('job_application', JobApplicationController::class);
Route::resource('job_application_detail', JobApplicationDetailController::class);



//case manager
Route::resource('case_manager', CaseManagerController::class);
//Route::get('employer_place_employment/{id}', [EmployerController::class, 'place_employment']);
