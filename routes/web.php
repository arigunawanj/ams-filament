<?php

use App\Http\Controllers\ExportController;
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
    return redirect('/admin');
});

// EXPORT

Route::get('admin/satuans/export', [ExportController::class, 'satuanExport'])->name('exportsatuan');
Route::get('admin/barangs/export', [ExportController::class, 'barangExport'])->name('exportbarang');
Route::get('admin/hargas/export', [ExportController::class, 'hargaExport'])->name('exportharga');
Route::get('admin/customers/export', [ExportController::class, 'customerExport'])->name('exportcustomer');
Route::get('admin/distributors/export', [ExportController::class, 'distributorExport'])->name('exportdistributor');
