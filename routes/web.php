<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
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

require __DIR__.'/auth.php';


Route::resource('location', App\Http\Controllers\LocationController::class);
Route::get('location/{location}/getscreens', [App\Http\Controllers\LocationController::class , 'getscreens'])->name('location.getscreens');
Route::get('sync_spl_cpl/{location}', [App\Http\Controllers\LocationController::class , 'sync_spl_cpl'])->name('location.sync_spl_cpl');
Route::get('refresh_all_data', [App\Http\Controllers\LocationController::class , 'refresh_all_data'])->name('refresh_all_data');
Route::get('refresh_all_data_by_location/{location}', [App\Http\Controllers\LocationController::class , 'refresh_all_data_of_location'])->name('refresh_all_data_of_location');
Route::get('refresh_content_of_location/{location}', [App\Http\Controllers\LocationController::class , 'refresh_content_of_location'])->name('refresh_content_of_location');



Route::resource('screen', App\Http\Controllers\ScreenController::class);

Route::get('spls/{location}/{spls}/get_spls', [App\Http\Controllers\SplController::class , 'getspls'])->name('spls.get_spls');
Route::get('spls/screen/{screen}', [App\Http\Controllers\SplController::class , 'spl_by_screen'])->name('spls.spls_by_screen');
Route::get('get_spl_with_filter', [App\Http\Controllers\SplController::class , 'get_spl_with_filter'])->name('spls.get_spl_with_filter');
Route::get('get_spl_infos/{spl}', [App\Http\Controllers\SplController::class , 'get_spl_infos'])->name('spls.get_spl_infos');


Route::get('cpls/{location}/{spls}/get_cpls', [App\Http\Controllers\CplController::class , 'getcpls'])->name('cpls.get_cpls');
Route::get('cpls/screen/{screen}', [App\Http\Controllers\CplController::class , 'cpl_by_screen'])->name('cpls.cpls_by_screen');
Route::get('get_cpl_with_filter', [App\Http\Controllers\CplController::class , 'get_cpl_with_filter'])->name('cpls.get_cpl_with_filter');


Route::get('kdms/{location}/{cpls}/get_kdms', [App\Http\Controllers\KdmController::class , 'getkdms'])->name('kdms.get_kdms');
Route::get('get_kdms_with_filter', [App\Http\Controllers\KdmController::class , 'get_Kdm_with_filter'])->name('kdms.get_Kdm_with_filter');

Route::get('getschedules/{location}/{spl}', [App\Http\Controllers\ScheduleContoller::class , 'getschedules'])->name('schedules.getschedules');
