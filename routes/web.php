<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployerAdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\JobRequestDetailController;
use App\Http\Controllers\security\PermissionsController;
use App\Http\Controllers\security\PermissionController;
use App\Http\Controllers\security\RoleController;
use App\Http\Controllers\security\UserController;
use App\Http\Controllers\security\AccountController;
use App\Http\Controllers\CaseManagerController;
use App\Http\Controllers\CityZipController;
use App\Http\Controllers\JobRequestAdminController;
use App\Http\Controllers\JobRequestFinantialController;


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
Route::resource('employer_admin', EmployerAdminController::class);
Route::get('get_naics_code/{id}', [EmployerController::class, 'get_naics_code']);

#counties
Route::get('get_counties/{id}', [CityZipController::class, 'get_counties']);



#cities
Route::get('get_cities/{id}', [CityZipController::class, 'get_cities']);


#codes zip
Route::get('get_zipcodes/{id}', [CityZipController::class, 'get_zipcodes']);


Route::post('employer_place_of_business', [EmployerController::class, 'employer_place_of_business']);
Route::post('employer_contact_information', [EmployerController::class, 'employer_contact_information']);

Route::post('employer_place_store', [EmployerController::class, 'employer_place_store']);
Route::post('employer_additional_location', [EmployerController::class, 'employer_additional_location']);
Route::post('employer/activate', [EmployerController::class, 'activate']);
Route::post('employer_admin/activate', [EmployerAdminController::class, 'activate']);
Route::post('employer/create_swa', [EmployerController::class, 'create_swa']);
Route::post('employer/delete_swa', [EmployerController::class, 'delete_swa']);
Route::get('employer/get_swa/{id}', [EmployerController::class, 'get_swa']);
Route::post('employer/update_swa', [EmployerController::class, 'update_swa']);
Route::get('profile_employer/{id}', [EmployerController::class, 'profile_employer']);

Route::post('job_request_deductions', [JobRequestController::class,'job_request_deductions']);
Route::post('job_request_requirements', [JobRequestController::class,'job_request_requirements']);
Route::post('job_request_representative', [JobRequestController::class,'job_request_representative']);
Route::post('job_request_sign', [JobRequestController::class,'job_request_sign']);
Route::resource('job_request_admin', JobRequestAdminController::class);
Route::resource('job_request_finantial', JobRequestFinantialController::class);
Route::post('job_request_finantial/pay', [JobRequestFinantialController::class,'pay']);

Route::get('job_request/get_div_deductions', [JobRequestController::class,'get_div_deductions']);
Route::get('job_request/get_div_deductions_medical', [JobRequestController::class,'get_div_deductions_medical']);
Route::resource('job_request', JobRequestController::class);

Route::resource('job_request_detail', JobRequestDetailController::class);
Route::get('job_request_detail/create/{id}', [JobRequestDetailController::class,'create_detail']);
Route::post('job_request_detail/delete', [JobRequestDetailController::class, 'delete']);
Route::post('job_request_detail/job_requirements', [JobRequestDetailController::class, 'job_requirements']);
Route::post('job_request_detail/job_offer_supervise', [JobRequestDetailController::class, 'job_offer_supervise']);
Route::post('job_request_detail/job_requirements_alternative', [JobRequestDetailController::class, 'job_requirements_alternative']);
Route::post('job_request_detail/english_levels', [JobRequestDetailController::class, 'english_levels']);

//case manager
Route::resource('case_manager', CaseManagerController::class);




Route::get('job_request/form9141/{id}', [JobRequestController::class, 'form9141']);
