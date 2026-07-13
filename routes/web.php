<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\MedicalStoreController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReceiptPrintController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('bills.index');
});

Route::resource('medical_stores', MedicalStoreController::class);
Route::resource('patients', PatientController::class);
Route::resource('medicines', MedicineController::class);
Route::resource('bills', BillController::class);

Route::get('/bills/{bill}/preview', [ReceiptPrintController::class, 'preview'])->name('bills.preview');
Route::get('/bills/{bill}/print', [ReceiptPrintController::class, 'print'])->name('bills.print');
