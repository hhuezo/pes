<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JobApplicationController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//validacion email
Route::get('validate_email/{id}', [RegisteredUserController::class, 'validate_email']);
Route::post('register_employer', [RegisteredUserController::class, 'store']);

Route::get('lang/{lang}', [LanguageController::class, 'swap'])->name('lang.swap');

require __DIR__.'/auth.php';


Route::resource('employer', EmployerController::class);
Route::post('employer_place_store', [EmployerController::class, 'employer_place_store']);
Route::post('employer_additional_location', [EmployerController::class,'employer_additional_location']);
Route::post('employer/activate', [EmployerController::class,'activate']);
Route::get('profile_employer/{id}', [EmployerController::class, 'profile_employer']);
Route::get('get_naics_code/{id}', [EmployerController::class, 'get_naics_code']);

Route::resource('job_application', JobApplicationController::class);


//Route::get('employer_place_employment/{id}', [EmployerController::class, 'place_employment']);



