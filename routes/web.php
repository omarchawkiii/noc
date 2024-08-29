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
//Route::get('/', [App\Http\Controllers\LocationController::class , 'index'])->name('location.index2');

Route::get('/', [App\Http\Controllers\SnmpController::class , 'get_snmp_with_map'])->name('snmp.get_snmp_with_map')->middleware(['auth']);
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/


require __DIR__.'/auth.php';

Auth::routes(['verify' => true,'register' => true, 'reset' => true]);


Route::resource('location', App\Http\Controllers\LocationController::class)->middleware(['auth']);
Route::delete('location/destroy', [App\Http\Controllers\LocationController::class , 'destroy'])->name('location.delete')->middleware(['auth']);
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
Route::get('refresh_lmscpl_content/{location}', [App\Http\Controllers\LocationController::class , 'refresh_lmscpl_content'])->name('refresh_lmscpl_content');
Route::get('refresh_lmsspl_content/{location}', [App\Http\Controllers\LocationController::class , 'refresh_lmsspl_content'])->name('refresh_lmsspl_content');
Route::get('refresh_lmskdm_content/{location}', [App\Http\Controllers\LocationController::class , 'refresh_lmskdm_content'])->name('refresh_lmskdm_content');
Route::get('refresh_schedule_content/{location}', [App\Http\Controllers\LocationController::class , 'refresh_schedule_content'])->name('refresh_schedule_content');
Route::get('refresh_snmp_data/{location}', [App\Http\Controllers\LocationController::class , 'refresh_snmp_data'])->name('refresh_snmp_data');



Route::resource('screen', App\Http\Controllers\ScreenController::class)->middleware(['auth']);

Route::get('spls/{location}/{spls}/get_spls', [App\Http\Controllers\SplController::class , 'getspls'])->name('spls.get_spls');
Route::get('spls/screen/{screen}', [App\Http\Controllers\SplController::class , 'spl_by_screen'])->name('spls.spls_by_screen')->middleware(['auth']);
Route::get('get_spl_with_filter', [App\Http\Controllers\SplController::class , 'get_spl_with_filter'])->name('spls.get_spl_with_filter')->middleware(['auth']);
Route::get('get_spl_infos/{spl}', [App\Http\Controllers\SplController::class , 'get_spl_infos'])->name('spls.get_spl_infos')->middleware(['auth']);
Route::get('spl_builder', [App\Http\Controllers\SplController::class , 'spl_builder'])->name('spls.spl_builder')->middleware(['auth']);
Route::get('upload', [App\Http\Controllers\SplController::class , 'upload_spl'])->name('spls.upload_spl')->middleware(['auth']);
Route::get('get_screens_from_spls', [App\Http\Controllers\SplController::class , 'get_screens_from_spls'])->name('cpls.get_screens_from_spls')->middleware(['auth']);
Route::get('spls/delete_spls', [App\Http\Controllers\SplController::class , 'delete_spls'])->name('spls.delete_spls')->middleware(['auth']);
Route::get('spls/download_spl', [App\Http\Controllers\SplController::class , 'download_spl'])->name('spls.download_spl')->middleware(['auth']);
Route::get('spls/clean_spls', [App\Http\Controllers\SplController::class , 'clean_spls'])->name('spls.clean_spls')->middleware(['auth']);



Route::get('cpls/{location}/{spls}/get_cpls', [App\Http\Controllers\CplController::class , 'getcpls'])->name('cpls.get_cpls');
Route::get('cpls/screen/{screen}', [App\Http\Controllers\CplController::class , 'cpl_by_screen'])->name('cpls.cpls_by_screen')->middleware(['auth']);
Route::get('get_cpl_with_filter', [App\Http\Controllers\CplController::class , 'get_cpl_with_filter'])->name('cpls.get_cpl_with_filter')->middleware(['auth']);
Route::get('get_cpl_infos/{location}/{cpl}', [App\Http\Controllers\CplController::class , 'get_cpl_infos'])->name('cpls.get_cpl_infos')->middleware(['auth']);
Route::get('get_cpl_with_filter_for_noc', [App\Http\Controllers\CplController::class , 'get_cpl_with_filter_for_noc'])->name('cpls.get_cpl_with_filter_for_noc')->middleware(['auth']);
Route::get('get_screens_from_cpls', [App\Http\Controllers\CplController::class , 'get_screens_from_cpls'])->name('cpls.get_screens_from_cpls')->middleware(['auth']);
Route::get('delete_cpls', [App\Http\Controllers\CplController::class , 'delete_cpl'])->name('cpls.delete_cpl')->middleware(['auth']);
Route::get('cpls/clean_cpls', [App\Http\Controllers\CplController::class , 'clean_cpls'])->name('cpls.clean_cpls')->middleware(['auth']);
Route::get('cpls/confirm_clean_cpls', [App\Http\Controllers\CplController::class , 'confirm_clean_cpls'])->name('cpls.confirm_clean_cpls')->middleware(['auth']);



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
Route::get('error_map', [App\Http\Controllers\SnmpController::class , 'get_snmp_with_map'])->name('snmp.error_map')->middleware(['auth']);




Route::get('getplayback/{location}', [App\Http\Controllers\PlaybackController::class , 'getplayback'])->name('playback.getplayback');
Route::get('refresh_playback', [App\Http\Controllers\LocationController::class , 'refresh_playback_data'])->name('playback.refresh_playback_data');

Route::get('playback', [App\Http\Controllers\PlaybackController::class , 'index'])->name('playback.index')->middleware(['auth']);

Route::get('get_playbak_detail', [App\Http\Controllers\PlaybackController::class , 'get_playbak_detail'])->name('playback.get_playbak_detail')->middleware(['auth']);



Route::get('getMacros/{location}', [App\Http\Controllers\MacroController::class , 'getMacros'])->name('macros.getMacros');

Route::post('createlocalspl', [App\Http\Controllers\NocsplController::class , 'createlocalspl'])->name('nocspl.createlocalspl')->middleware(['auth']);
Route::get('get_nocspl', [App\Http\Controllers\NocsplController::class , 'get_nocspl'])->name('nocspl.get_nocspl')->middleware(['auth']);
Route::get('get_nocspl_to_ingest', [App\Http\Controllers\NocsplController::class , 'get_nocspl_to_ingest'])->name('nocspl.get_nocspl_to_ingest')->middleware(['auth']);
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
Route::post('unlink_all_spl_movie', [App\Http\Controllers\MoviescodController::class , 'unlink_all_spl_movie'])->name('moviescod.unlink_all_spl_movie')->middleware(['auth']);
Route::get('get_spl_and_movies_to_schedule/{location}', [App\Http\Controllers\MoviescodController::class , 'get_spl_and_movies_to_schedule'])->name('moviescod.get_spl_and_movies_to_schedule')->middleware(['auth']);
Route::get('get_spl_and_movies_scheduled/{location}', [App\Http\Controllers\MoviescodController::class , 'get_spl_and_movies_scheduled'])->name('moviescod.get_spl_and_movies_scheduled')->middleware(['auth']);
Route::post('cancel_movies_to_spls', [App\Http\Controllers\MoviescodController::class , 'cancel_movies_to_spls'])->name('moviescod.cancel_movies_to_spls')->middleware(['auth']);


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
Route::post('user/check_email', [App\Http\Controllers\UserController::class , 'check_email'])->name('users.check_email')->middleware(['auth']);
Route::post('user/check_username', [App\Http\Controllers\UserController::class , 'check_username'])->name('users.check_username')->middleware(['auth']);


Route::get('ingester/', [App\Http\Controllers\IngersterController::class , 'index'])->name('ingester.index')->middleware(['auth']);
Route::post('ingester/action_contoller', [App\Http\Controllers\IngersterController::class , 'action_contoller'])->name('ingester.action_contoller')->middleware(['auth']);
Route::get('transfere_content', [App\Http\Controllers\IngersterController::class , 'transfere_content'])->name('ingester.transfere_content')->middleware(['auth']);
Route::delete('ingester/delete_transfered_file', [App\Http\Controllers\IngersterController::class , 'delete_transfered_file'])->name('ingester.delete_transfered_file')->middleware(['auth']);
Route::post('ingester/generate_torrent_file', [App\Http\Controllers\IngersterController::class , 'generate_torrent_file'])->name('ingester.generate_torrent_file')->middleware(['auth']);
Route::post('ingester/generate_torrent_file_multi_locations', [App\Http\Controllers\IngersterController::class , 'generate_torrent_file_multi_locations'])->name('ingester.generate_torrent_file_multi_locations')->middleware(['auth']);
Route::get('ingest/logs', [App\Http\Controllers\IngersterController::class , 'logs'])->name('ingester.logs')->middleware(['auth']);
Route::get('ingest/monitors', [App\Http\Controllers\IngersterController::class , 'monitors'])->name('ingester.monitors')->middleware(['auth']);
Route::get('ingest/logs_details', [App\Http\Controllers\IngersterController::class , 'logs_details'])->name('ingester.logs_details')->middleware(['auth']);




Route::get('sources', [App\Http\Controllers\IngestsourceController::class , 'index'])->name('ingestersources.index')->middleware(['auth']);
Route::post('ingestersources/store', [App\Http\Controllers\IngestsourceController::class , 'store'])->name('ingestersources.store')->middleware(['auth']);


Route::get('settings', [App\Http\Controllers\ConfigController::class , 'edit'])->name('config.edit');
Route::put('settings/update', [App\Http\Controllers\ConfigController::class , 'update'])->name('config.update')->middleware(['auth']);
Route::put('settings/update_auto_ingest', [App\Http\Controllers\ConfigController::class , 'update_auto_ingest'])->name('config.update_auto_ingest')->middleware(['auth']);
Route::put('settings/transfer_settings', [App\Http\Controllers\ConfigController::class , 'transfer_settings'])->name('config.transfer_settings')->middleware(['auth']);

Route::get('get_asset_infos/{location}', [App\Http\Controllers\AssetinfoController::class , 'get_asset_infos'])->name('asset_infos.get_asset_infos')->middleware(['auth']);
Route::get('asset_reports', [App\Http\Controllers\AssetinfoController::class , 'display_performane_log'])->name('asset_infos.display_performance_log')->middleware(['auth']);

Route::get('get_asset_infos_with_filter', [App\Http\Controllers\AssetinfoController::class , 'get_asset_infos_with_filter'])->name('asset_infos.get_asset_infos_with_filter')->middleware(['auth']);

Route::get('generate_pdf_asset_info', [App\Http\Controllers\AssetinfoController::class , 'generate_pdf_asset_info'])->name('asset_infos.generate_pdf_asset_info')->middleware(['auth']);
Route::get('refresh_asset_infos_data', [App\Http\Controllers\LocationController::class , 'refresh_asset_infos_data'])->name('location.refresh_asset_infos_data')->middleware(['auth']);

Route::get('get_error_list/{location}', [App\Http\Controllers\Error_listController::class , 'get_error_list'])->name('error_list.get_error_list')->middleware(['auth']);
Route::get('get_header_error', [App\Http\Controllers\Error_listController::class , 'header_errors'])->name('error_list.header_errors')->middleware(['auth']);
Route::get('get_kdm_errors_list', [App\Http\Controllers\Error_listController::class , 'kdms_errors_list'])->name('error_list.kdms_errors_list')->middleware(['auth']);
Route::get('get_sound_errors_list', [App\Http\Controllers\Error_listController::class , 'sound_errors_list'])->name('error_list.sound_errors_list')->middleware(['auth']);
Route::get('get_server_errors_list', [App\Http\Controllers\Error_listController::class , 'server_errors_list'])->name('error_list.server_errors_list')->middleware(['auth']);
Route::get('get_projector_errors_list', [App\Http\Controllers\Error_listController::class , 'projector_errors_list'])->name('error_list.get_projector_errors_list')->middleware(['auth']);
Route::get('get_storage_errors_list', [App\Http\Controllers\Error_listController::class , 'storage_errors_list'])->name('error_list.get_storage_errors_list')->middleware(['auth']);
Route::get('get_unlinked_sessions_errors_list', [App\Http\Controllers\Error_listController::class , 'get_unlinked_sessions_errors_list'])->name('error_list.get_unlinked_sessions_errors_list')->middleware(['auth']);

Route::get('planner', [App\Http\Controllers\PlannerController::class , 'index'])->name('planner.index')->middleware(['auth']);
Route::get('get_palnner_form_data', [App\Http\Controllers\PlannerController::class , 'get_palnner_form_data'])->name('planner.get_palnner_form_data')->middleware(['auth']);
Route::post('planner/store', [App\Http\Controllers\PlannerController::class , 'store'])->name('planner.store')->middleware(['auth']);
Route::get('get_plans', [App\Http\Controllers\PlannerController::class , 'get_plans'])->name('planner.get_plans')->middleware(['auth']);
Route::get('get_templates', [App\Http\Controllers\PlannerController::class , 'get_templates'])->name('planner.get_templates')->middleware(['auth']);

Route::post('rule/store', [App\Http\Controllers\PlannerController::class , 'rule_store'])->name('planner.rule_store')->middleware(['auth']);

Route::get('storage_reports', [App\Http\Controllers\LogstitleController::class , 'storage_reports'])->name('storage_reports');


Route::get('inventory_category', [App\Http\Controllers\InventoryCategoryController::class , 'index'])->name('inventory_category.index')->middleware(['auth']);
Route::get('inventory_category/get_categories', [App\Http\Controllers\InventoryCategoryController::class , 'get_categories'])->name('inventory_category.get_categories')->middleware(['auth']);
Route::post('inventory_category/store', [App\Http\Controllers\InventoryCategoryController::class , 'store'])->name('inventory_category.store')->middleware(['auth']);
Route::delete('inventory_category/{id}/destroy', [App\Http\Controllers\InventoryCategoryController::class , 'destroy'])->name('inventory_category.destroy')->middleware(['auth']);
Route::get('inventory_category/{id}/show', [App\Http\Controllers\InventoryCategoryController::class , 'show'])->name('inventory_category.show')->middleware(['auth']);
Route::put('inventory_category/update', [App\Http\Controllers\InventoryCategoryController::class , 'update'])->name('inventory_category.update')->middleware(['auth']);

Route::get('part', [App\Http\Controllers\PartController::class , 'index'])->name('part.index')->middleware(['auth']);
Route::get('part/get_parts', [App\Http\Controllers\PartController::class , 'get_parts'])->name('part.get_parts')->middleware(['auth']);
Route::post('part/store', [App\Http\Controllers\PartController::class , 'store'])->name('part.store')->middleware(['auth']);
Route::delete('part/{id}/destroy', [App\Http\Controllers\PartController::class , 'destroy'])->name('part.destroy')->middleware(['auth']);
Route::get('part/{id}/show', [App\Http\Controllers\PartController::class , 'show'])->name('part.show')->middleware(['auth']);
Route::put('part/update', [App\Http\Controllers\PartController::class , 'update'])->name('part.update')->middleware(['auth']);

Route::get('supplier', [App\Http\Controllers\SupplierController::class , 'index'])->name('supplier.index')->middleware(['auth']);
Route::get('supplier/get_suppliers', [App\Http\Controllers\SupplierController::class , 'get_suppliers'])->name('supplier.get_suppliers')->middleware(['auth']);
Route::post('supplier/store', [App\Http\Controllers\SupplierController::class , 'store'])->name('supplier.store')->middleware(['auth']);
Route::delete('supplier/{id}/destroy', [App\Http\Controllers\SupplierController::class , 'destroy'])->name('supplier.destroy')->middleware(['auth']);
Route::get('supplier/{id}/show', [App\Http\Controllers\SupplierController::class , 'show'])->name('supplier.show')->middleware(['auth']);
Route::put('supplier/update', [App\Http\Controllers\SupplierController::class , 'update'])->name('supplier.update')->middleware(['auth']);

Route::get('cinema_location', [App\Http\Controllers\CinemaLocationController::class , 'index'])->name('cinema_location.index')->middleware(['auth']);
Route::get('cinema_location/get_cinema_locations', [App\Http\Controllers\CinemaLocationController::class , 'get_cinema_locations'])->name('cinema_location.get_cinema_locations')->middleware(['auth']);
Route::post('cinema_location/store', [App\Http\Controllers\CinemaLocationController::class , 'store'])->name('cinema_location.store')->middleware(['auth']);
Route::delete('cinema_location/{id}/destroy', [App\Http\Controllers\CinemaLocationController::class , 'destroy'])->name('cinema_location.destroy')->middleware(['auth']);
Route::get('cinema_location/{id}/show', [App\Http\Controllers\CinemaLocationController::class , 'show'])->name('cinema_location.show')->middleware(['auth']);
Route::put('cinema_location/update', [App\Http\Controllers\CinemaLocationController::class , 'update'])->name('cinema_location.update')->middleware(['auth']);

Route::get('storage_location', [App\Http\Controllers\StorageLocationController::class , 'index'])->name('storage_location.index')->middleware(['auth']);
Route::get('storage_location/get_storage_locations', [App\Http\Controllers\StorageLocationController::class , 'get_storage_locations'])->name('storage_location.get_storage_locations')->middleware(['auth']);
Route::post('storage_location/store', [App\Http\Controllers\StorageLocationController::class , 'store'])->name('storage_location.store')->middleware(['auth']);
Route::delete('storage_location/{id}/destroy', [App\Http\Controllers\StorageLocationController::class , 'destroy'])->name('storage_location.destroy')->middleware(['auth']);
Route::get('storage_location/{id}/show', [App\Http\Controllers\StorageLocationController::class , 'show'])->name('storage_location.show')->middleware(['auth']);
Route::put('storage_location/update', [App\Http\Controllers\StorageLocationController::class , 'update'])->name('storage_location.update')->middleware(['auth']);

Route::get('inventory_in', [App\Http\Controllers\InventoryInController::class , 'index'])->name('inventory_in.index')->middleware(['auth']);
Route::get('inventory_in/get_part_from_category', [App\Http\Controllers\InventoryInController::class , 'get_part_from_category'])->name('inventory_in.get_part_from_category')->middleware(['auth']);
Route::get('inventory_in/get_description_from_part', [App\Http\Controllers\InventoryInController::class , 'get_description_from_part'])->name('inventory_in.get_description_from_part')->middleware(['auth']);
Route::post('inventory_in/store', [App\Http\Controllers\InventoryInController::class , 'store'])->name('InventoryInController.store')->middleware(['auth']);
Route::get('inventory_in/get_inventories_in', [App\Http\Controllers\InventoryInController::class , 'get_inventories_in'])->name('InventoryInController.get_inventories_in')->middleware(['auth']);

Route::get('inventory_out', [App\Http\Controllers\InventoryOutController::class , 'index'])->name('inventory_out.index')->middleware(['auth']);
Route::get('inventory_out/get_part_from_category', [App\Http\Controllers\InventoryOutController::class , 'get_part_from_category'])->name('inventory_out.get_part_from_category')->middleware(['auth']);
Route::get('inventory_out/get_description_from_part', [App\Http\Controllers\InventoryOutController::class , 'get_description_from_part'])->name('inventory_out.get_description_from_part')->middleware(['auth']);
Route::post('inventory_out/store', [App\Http\Controllers\InventoryOutController::class , 'store'])->name('inventory_out.store')->middleware(['auth']);
Route::get('inventory_out/get_inventories_out', [App\Http\Controllers\InventoryOutController::class , 'get_inventories_out'])->name('inventory_out.get_inventories_out')->middleware(['auth']);
Route::put('inventory_out/{id}/approuve', [App\Http\Controllers\InventoryOutController::class , 'approuve'])->name('inventory_out.approuve')->middleware(['auth']);


Route::get('transfer_request', [App\Http\Controllers\TransferRequestController::class , 'index'])->name('transfer_request.index')->middleware(['auth']);
Route::get('transfer_request/get_part_from_category', [App\Http\Controllers\TransferRequestController::class , 'get_part_from_category'])->name('transfer_request.get_part_from_category')->middleware(['auth']);
Route::get('transfer_request/get_description_from_part', [App\Http\Controllers\TransferRequestController::class , 'get_description_from_part'])->name('transfer_request.get_description_from_part')->middleware(['auth']);
Route::post('transfer_request/store', [App\Http\Controllers\TransferRequestController::class , 'store'])->name('transfer_request.store')->middleware(['auth']);
Route::get('transfer_request/get_transfer_requests', [App\Http\Controllers\TransferRequestController::class , 'get_transfer_requests'])->name('transfer_request.get_transfer_requests')->middleware(['auth']);
Route::put('transfer_request/{id}/approuve', [App\Http\Controllers\TransferRequestController::class , 'approuve'])->name('transfer_request.approuve')->middleware(['auth']);
