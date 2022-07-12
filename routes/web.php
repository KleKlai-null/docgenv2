<?php

use App\Http\Controllers\UserManagement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WithdrawalSlipController;
use App\Http\Controllers\VerifyDocuments;
use App\Http\Controllers\ActivityLogController;

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
    return redirect()->route('slip.create');
});

Route::group(['middleware'  => 'auth'], function () {

    /**
     * User Management
     */
    Route::resource('/user', UserManagement::class);
    Route::get('/user-status/{user}', [UserManagement::class, 'activateDeactive'])->name('user.status-change');

    /**
     * Activity Log
     */
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log');

    Route::get('/history-log', [WithdrawalSlipController::class, 'index'])->name('history-log');
    Route::get('/search-slip', [WithdrawalSlipController::class, 'index'])->name('slip.search');
    Route::get('/create-slip', [WithdrawalSlipController::class, 'create'])->name('slip.create');
    Route::post('/save-slip', [WithdrawalSlipController::class, 'store'])->name('slip.save');
    Route::get('/view-slip/{withdrawalSlip}', [WithdrawalSlipController::class, 'show'])->name('slip.view');
    Route::get('/generate-pdf/{id}', [WithdrawalSlipController::class, 'generatePDF'])->name('generate.pdf');
});

// Public Access
Route::get('/verify/{key?}', [VerifyDocuments::class, 'Verify_documents']);

require __DIR__.'/auth.php';
