<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
})->name('awal');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Prefix Report
Route::prefix('report')->group(function (){

    Route::middleware(['auth'])->group(function () {

        Route::get('/chart', [App\Http\Controllers\UptimeController::class, 'get_chart'])->name('get.chart');
        Route::get('/chart/{nama_platform}', [App\Http\Controllers\UptimeController::class, 'get_chart_detail'])->name('get.chart.detail');

        Route::get('/uptime', [App\Http\Controllers\UptimeController::class, 'get_uptime'])->name('get.uptime');

        Route::get('/uptime/backup', [App\Http\Controllers\UptimeController::class, 'backup_uptime'])->name('get.uptime.backup');
        Route::get('/history', [App\Http\Controllers\UptimeController::class, 'uptime_history'])->name('get.uptime.history');
        Route::get('/history/{date}', [App\Http\Controllers\UptimeController::class, 'uptime_history_date'])->name('get.uptime.history.date');
        Route::delete('/history/{date}', [App\Http\Controllers\UptimeController::class, 'delete_uptime_history_date'])->name('delete.uptime.history.date');
        Route::get('/history/{date}/export/excel', [App\Http\Controllers\UptimeController::class, 'uptime_history_date_excel'])->name('get.uptime.history.date.excel');
    });

});

// No Prefix
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
});

