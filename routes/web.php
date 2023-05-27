<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
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

// Export
Route::get('admin/satuans/export', [ExportController::class, 'satuanExport'])->name('exportsatuan');
Route::get('admin/barangs/export', [ExportController::class, 'barangExport'])->name('exportbarang');
Route::get('admin/hargas/export', [ExportController::class, 'hargaExport'])->name('exportharga');
Route::get('admin/customers/export', [ExportController::class, 'customerExport'])->name('exportcustomer');
Route::get('admin/distributors/export', [ExportController::class, 'distributorExport'])->name('exportdistributor');

// Import
Route::post('admin/satuans/import', [ImportController::class, 'satuanImport'])->name('importsatuan');
Route::post('admin/barangs/import', [ImportController::class, 'barangImport'])->name('importbarang');
Route::post('admin/hargas/import', [ImportController::class, 'hargaImport'])->name('importharga');
Route::post('admin/customers/import', [ImportController::class, 'customerImport'])->name('importcustomer');
Route::post('admin/distributors/import', [ImportController::class, 'distributorImport'])->name('importdistributor');
