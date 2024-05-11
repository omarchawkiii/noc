<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
/*
Route::get('/', function () {
    return view('locations.index');
});*/
//Route::get('/', [App\Http\Controllers\LocationController::class , 'index'])->name('location.index');

Route::get('/', [App\Http\Controllers\SnmpController::class , 'get_snmp_with_map'])->name('snmp.get_snmp_with_map')->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Auth::routes(['verify' => true,'register' => false, 'reset' => false]);


Route::resource('location', App\Http\Controllers\LocationController::class)->middleware(['auth']);
Route::get('location_infos/{location}', [App\Http\Controllers\LocationController::class , 'location_infos'])->name('location.location_infos')->middleware(['auth']);
Route::get('location/{location}/getscreens', [App\Http\Controllers\LocationController::class , 'getscreens'])->name('location.getscreens');
Route::get('sync_spl_cpl/{location}', [App\Http\Controllers\LocationController::class , 'sync_spl_cpl'])->name('location.sync_spl_cpl');
Route::get('refresh_all_data', [App\Http\Controllers\LocationController::class , 'refresh_all_data'])->name('refresh_all_data');
Route::get('refresh_all_data_by_location/{location}', [App\Http\Controllers\LocationController::class , 'refresh_all_data_of_location'])->name('refresh_all_data_of_location');
Route::get('refresh_content_of_location/{location}', [App\Http\Controllers\LocationController::class , 'refresh_content_of_location'])->name('refresh_content_of_location');
Route::get('refresh_lms_data_of_location/{location}', [App\Http\Controllers\LocationController::class , 'refresh_lms_data_of_location'])->name('refresh_lms_data_of_location');
Route::get('refresh_spl_content/{location}', [App\Http\Controllers\LocationController::class , 'refresh_spl_content'])->name('refresh_spl_content');
Route::get('refresh_cpl_content/{location}', [App\Http\Controllers\LocationController::class , 'refresh_cpl_content'])->name('refresh_cpl_content');
Route::get('refresh_kdm_content/{location}', [App\Http\Controllers\LocationController::class , 'refresh_kdm_content'])->name('refresh_kdm_content');
Route::get('refresh_macro_data_by_location/{location}', [App\Http\Controllers\LocationController::class , 'refresh_macro_data_by_location'])->name('refresh_macro_data_by_location');




Route::resource('screen', App\Http\Controllers\ScreenController::class)->middleware(['auth']);

Route::get('spls/{location}/{spls}/get_spls', [App\Http\Controllers\SplController::class , 'getspls'])->name('spls.get_spls');
Route::get('spls/screen/{screen}', [App\Http\Controllers\SplController::class , 'spl_by_screen'])->name('spls.spls_by_screen')->middleware(['auth']);
Route::get('get_spl_with_filter', [App\Http\Controllers\SplController::class , 'get_spl_with_filter'])->name('spls.get_spl_with_filter')->middleware(['auth']);
Route::get('get_spl_infos/{spl}', [App\Http\Controllers\SplController::class , 'get_spl_infos'])->name('spls.get_spl_infos')->middleware(['auth']);
Route::get('spl_builder', [App\Http\Controllers\SplController::class , 'spl_builder'])->name('spls.spl_builder')->middleware(['auth']);
Route::get('upload', [App\Http\Controllers\SplController::class , 'upload_spl'])->name('spls.upload_spl')->middleware(['auth']);
Route::get('get_screens_from_spls', [App\Http\Controllers\SplController::class , 'get_screens_from_spls'])->name('cpls.get_screens_from_spls')->middleware(['auth']);
Route::get('spls/delete_spls', [App\Http\Controllers\SplController::class , 'delete_spls'])->name('cpls.delete_spls')->middleware(['auth']);
Route::get('spls/download_spl', [App\Http\Controllers\SplController::class , 'download_spl'])->name('cpls.delete_spls')->middleware(['auth']);


Route::get('cpls/{location}/{spls}/get_cpls', [App\Http\Controllers\CplController::class , 'getcpls'])->name('cpls.get_cpls');
Route::get('cpls/screen/{screen}', [App\Http\Controllers\CplController::class , 'cpl_by_screen'])->name('cpls.cpls_by_screen')->middleware(['auth']);
Route::get('get_cpl_with_filter', [App\Http\Controllers\CplController::class , 'get_cpl_with_filter'])->name('cpls.get_cpl_with_filter')->middleware(['auth']);
Route::get('get_cpl_infos/{location}/{cpl}', [App\Http\Controllers\CplController::class , 'get_cpl_infos'])->name('cpls.get_cpl_infos')->middleware(['auth']);
Route::get('get_cpl_with_filter_for_noc', [App\Http\Controllers\CplController::class , 'get_cpl_with_filter_for_noc'])->name('cpls.get_cpl_with_filter_for_noc')->middleware(['auth']);
Route::get('get_screens_from_cpls', [App\Http\Controllers\CplController::class , 'get_screens_from_cpls'])->name('cpls.get_screens_from_cpls')->middleware(['auth']);
Route::get('delete_cpls', [App\Http\Controllers\CplController::class , 'delete_cpl'])->name('cpls.delete_cpl')->middleware(['auth']);


Route::get('kdms/{location}/{cpls}/get_kdms', [App\Http\Controllers\KdmController::class , 'getkdms'])->name('kdms.get_kdms');
Route::get('get_kdms_with_filter', [App\Http\Controllers\KdmController::class , 'get_Kdm_with_filter'])->name('kdms.get_Kdm_with_filter')->middleware(['auth']);

Route::get('getschedules/{location}', [App\Http\Controllers\ScheduleContoller::class , 'getschedules'])->name('schedules.getschedules');
Route::get('get_schedules_with_filter', [App\Http\Controllers\ScheduleContoller::class , 'get_schedules_with_filter'])->name('schedules.get_schedules_with_filter')->middleware(['auth']);
Route::get('get_unlinked_spl', [App\Http\Controllers\ScheduleContoller::class , 'get_unlinked_spl'])->name('schedules.get_unlinked_spl')->middleware(['auth']);
Route::get('get_need_kdm', [App\Http\Controllers\ScheduleContoller::class , 'get_need_kdm'])->name('schedules.get_need_kdm')->middleware(['auth']);

Route::get('get_schedule_infos', [App\Http\Controllers\ScheduleContoller::class , 'get_schedule_infos'])->name('schedules.get_schedule_infos')->middleware(['auth']);


Route::get('lmsspls/{location}/getlmsspls', [App\Http\Controllers\LmssplController::class , 'getlmsspls'])->name('lmsspls.getlmsspls');
Route::get('lmscpls/{location}/getlmscpls', [App\Http\Controllers\LmscplController::class , 'getlmscpls'])->name('lmscpls.getlmscpls');
Route::get('lmskdms/{location}/getlmskdms', [App\Http\Controllers\LmskdmController::class , 'getlmskdms'])->name('lmskdms.getlmskdms');

Route::get('sync_lms_spl_cpl/{location}', [App\Http\Controllers\LocationController::class , 'sync_lms_spl_cpl'])->name('location.sync_lms_spl_cpl');
Route::get('get_lmsspl_infos/{spl}', [App\Http\Controllers\LmssplController::class , 'get_lmsspl_infos'])->name('slmscplsls.get_lmsspl_infos');
Route::get('get_lmscpl_infos/{cpl}', [App\Http\Controllers\LmscplController::class , 'get_lmscpl_infos'])->name('cpls.get_lmscpl_infos');


Route::get('getdiskusage/{location}', [App\Http\Controllers\DiskusageController::class , 'getdiskusage'])->name('diskusage.getdiskusage')->middleware(['auth']);

Route::get('getsnmp/{location}', [App\Http\Controllers\SnmpController::class , 'getsnmp'])->name('snmp.getsnmp')->middleware(['auth']);
Route::get('snmp', [App\Http\Controllers\SnmpController::class , 'get_snmp_with_filter'])->name('snmp.get_snmp_with_filter')->middleware(['auth']);
Route::get('error_map', [App\Http\Controllers\SnmpController::class , 'get_snmp_with_map'])->name('snmp.get_snmp_with_map')->middleware(['auth']);




Route::get('getplayback/{location}', [App\Http\Controllers\PlaybackController::class , 'getplayback'])->name('playback.getplayback');
Route::get('playback', [App\Http\Controllers\PlaybackController::class , 'index'])->name('playback.index')->middleware(['auth']);

Route::get('get_playbak_detail', [App\Http\Controllers\PlaybackController::class , 'get_playbak_detail'])->name('playback.get_playbak_detail')->middleware(['auth']);



Route::get('getMacros/{location}', [App\Http\Controllers\MacroController::class , 'getMacros'])->name('macros.getMacros');

Route::post('createlocalspl', [App\Http\Controllers\NocsplController::class , 'createlocalspl'])->name('nocspl.createlocalspl')->middleware(['auth']);
Route::get('get_nocspl', [App\Http\Controllers\NocsplController::class , 'get_nocspl'])->name('nocspl.get_nocspl')->middleware(['auth']);
Route::get('open_nocspl', [App\Http\Controllers\NocsplController::class , 'openlocalspl'])->name('nocspl.openlocalspl')->middleware(['auth']);
Route::get('delete_nocspl', [App\Http\Controllers\NocsplController::class , 'delete_nocspl'])->name('nocspl.delete_nocspl')->middleware(['auth']);
Route::post('sendXmlFileToApi', [App\Http\Controllers\NocsplController::class , 'sendXmlFileToApi'])->name('nocspl.sendXmlFileToApi')->middleware(['auth']);
Route::post('checkAvailability', [App\Http\Controllers\NocsplController::class , 'checkAvailability'])->name('nocspl.checkAvailability')->middleware(['auth']);

Route::post('checkCplsInLocation', [App\Http\Controllers\NocsplController::class , 'checkCplsInLocation'])->name('nocspl.checkCplsInLocation')->middleware(['auth']);
Route::post('uploadlocalspl', [App\Http\Controllers\NocsplController::class , 'uploadlocalspl'])->name('nocspl.uploadlocalspl')->middleware(['auth']);
Route::delete('localspl/{id}/destroy', [App\Http\Controllers\NocsplController::class , 'destroy'])->name('nocspl.destroy')->middleware(['auth']);
Route::post('upload_spl_after_edit', [App\Http\Controllers\NocsplController::class , 'upload_spl_after_edit'])->name('nocspl.upload_spl_after_edit')->middleware(['auth']);


Route::get('getMoviesCods/{location}', [App\Http\Controllers\MoviescodController::class , 'getMoviesCods'])->name('moviescod.getmoviescods');
Route::get('get_spl_and_movies/{location}', [App\Http\Controllers\MoviescodController::class , 'get_spl_and_movies'])->name('moviescod.get_spl_and_movies')->middleware(['auth']);
Route::post('add_movies_to_spls', [App\Http\Controllers\MoviescodController::class , 'add_movies_to_spls'])->name('moviescod.MoviescodController')->middleware(['auth']);
Route::get('get_spl_and_movies_linked/{location}', [App\Http\Controllers\MoviescodController::class , 'get_spl_and_movies_linked'])->name('moviescod.get_spl_and_movies_linked')->middleware(['auth']);
Route::post('unlink_spl_movie', [App\Http\Controllers\MoviescodController::class , 'unlink_spl_movie'])->name('moviescod.unlink_spl_movie')->middleware(['auth']);


Route::post('uploadlocalkdm', [App\Http\Controllers\NockdmController::class , 'uploadlocalkdm'])->name('nockdm.uploadlocalkdm')->middleware(['auth']);
Route::get('get_nockdm', [App\Http\Controllers\NockdmController::class , 'get_nockdm'])->name('nockdm.get_nockdm')->middleware(['auth']);
Route::post('uploadexistingkdm', [App\Http\Controllers\NockdmController::class , 'uploadexistingkdm'])->name('nockdm.uploadexistingkdm')->middleware(['auth']);
Route::delete('localkdm/{id}/destroy', [App\Http\Controllers\NockdmController::class , 'destroy'])->name('nockdm.destroy')->middleware(['auth']);
Route::delete('localkdm/delete_all', [App\Http\Controllers\NockdmController::class , 'delete_all'])->name('nockdm.delete_all')->middleware(['auth']);


Route::get('getlogs/{location}', [App\Http\Controllers\LogController::class , 'get_logs'])->name('logs.getlogs');
Route::get('performance_logs', [App\Http\Controllers\LogController::class , 'get_performance_log'])->name('logs.get_performance_log')->middleware(['auth']);
Route::get('get_screen_from_location', [App\Http\Controllers\LogController::class , 'get_screen_from_location'])->name('logs.get_screen_from_location')->middleware(['auth']);
Route::get('get_suggestion_cpls', [App\Http\Controllers\LogController::class , 'get_suggestion_cpls'])->name('logs.get_suggestion_cpls')->middleware(['auth']);
Route::get('getListlogs', [App\Http\Controllers\LogController::class , 'getListlogs'])->name('logs.getListlogs')->middleware(['auth']);
Route::get('generate_pdf_report', [App\Http\Controllers\LogController::class , 'generate_pdf_report'])->name('logs.generate_pdf_report')->middleware(['auth']);

Route::get('get_logstitle/{location}', [App\Http\Controllers\LogstitleController::class , 'get_logstitle'])->name('logstitle.get_logstitle');

Route::get('asset_reports', [App\Http\Controllers\LogstitleController::class , 'asset_reports'])->name('asset_reports');
Route::get('lamp_reports', [App\Http\Controllers\LogstitleController::class , 'lamp_reports'])->name('lamp_reports');

Route::get('user/create', [App\Http\Controllers\UserController::class , 'create'])->name('users.create')->middleware(['auth']);
Route::post('user/store', [App\Http\Controllers\UserController::class , 'store'])->name('users.store')->middleware(['auth']);
Route::get('user', [App\Http\Controllers\UserController::class , 'index'])->name('users.index')->middleware(['auth']);
Route::delete('user/{id}/destroy', [App\Http\Controllers\UserController::class , 'destroy'])->name('users.destroy')->middleware(['auth']);
Route::get('user/{id}/show', [App\Http\Controllers\UserController::class , 'show'])->name('users.show')->middleware(['auth']);
Route::get('get_users', [App\Http\Controllers\UserController::class , 'get_users'])->name('users.get_users')->middleware(['auth']);
Route::put('user/update', [App\Http\Controllers\UserController::class , 'update'])->name('users.update')->middleware(['auth']);
Route::put('user/update_password', [App\Http\Controllers\UserController::class , 'update_password'])->name('users.update_password')->middleware(['auth']);


Route::get('ingester/', [App\Http\Controllers\IngersterController::class , 'index'])->name('ingester.index')->middleware(['auth']);
Route::post('ingester/action_contoller', [App\Http\Controllers\IngersterController::class , 'action_contoller'])->name('ingester.action_contoller')->middleware(['auth']);
Route::get('transfere_content', [App\Http\Controllers\IngersterController::class , 'transfere_content'])->name('ingester.transfere_content')->middleware(['auth']);
Route::delete('ingester/delete_transfered_file', [App\Http\Controllers\IngersterController::class , 'delete_transfered_file'])->name('ingester.delete_transfered_file')->middleware(['auth']);
Route::post('ingester/generate_torrent_file', [App\Http\Controllers\IngersterController::class , 'generate_torrent_file'])->name('ingester.generate_torrent_file')->middleware(['auth']);




Route::get('sources', [App\Http\Controllers\IngestsourceController::class , 'index'])->name('ingestersources.index')->middleware(['auth']);
Route::post('ingestersources/store', [App\Http\Controllers\IngestsourceController::class , 'store'])->name('ingestersources.store')->middleware(['auth']);


Route::get('settings', [App\Http\Controllers\ConfigController::class , 'edit'])->name('config.edit');
Route::put('settings/update', [App\Http\Controllers\ConfigController::class , 'update'])->name('config.update')->middleware(['auth']);
Route::put('settings/update_auto_ingest', [App\Http\Controllers\ConfigController::class , 'update_auto_ingest'])->name('config.update_auto_ingest')->middleware(['auth']);


Route::get('get_asset_infos/{location}', [App\Http\Controllers\AssetinfoController::class , 'get_asset_infos'])->name('asset_infos.get_asset_infos')->middleware(['auth']);
Route::get('asset_reports', [App\Http\Controllers\AssetinfoController::class , 'display_performane_log'])->name('asset_infos.display_performance_log')->middleware(['auth']);

Route::get('get_asset_infos_with_filter', [App\Http\Controllers\AssetinfoController::class , 'get_asset_infos_with_filter'])->name('asset_infos.get_asset_infos_with_filter')->middleware(['auth']);

Route::get('generate_pdf_asset_info', [App\Http\Controllers\AssetinfoController::class , 'generate_pdf_asset_info'])->name('asset_infos.generate_pdf_asset_info')->middleware(['auth']);
Route::get('refresh_asset_infos_data', [App\Http\Controllers\LocationController::class , 'refresh_asset_infos_data'])->name('location.refresh_asset_infos_data')->middleware(['auth']);


Route::get('get_error_list/{location}', [App\Http\Controllers\Error_listController::class , 'get_error_list'])->name('error_list.get_error_list')->middleware(['auth']);
Route::get('get_header_error', [App\Http\Controllers\Error_listController::class , 'header_errors'])->name('error_list.get_error_list')->middleware(['auth']);
Route::get('get_kdm_errors_list', [App\Http\Controllers\Error_listController::class , 'kdms_errors_list'])->name('error_list.kdms_errors_list')->middleware(['auth']);
Route::get('get_server_errors_list', [App\Http\Controllers\Error_listController::class , 'server_errors_list'])->name('error_list.server_errors_list')->middleware(['auth']);
Route::get('get_projector_errors_list', [App\Http\Controllers\Error_listController::class , 'projector_errors_list'])->name('error_list.get_projector_errors_list')->middleware(['auth']);
