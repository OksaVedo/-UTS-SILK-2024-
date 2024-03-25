<?php

use App\Http\Controllers\PatientController;
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
    return view('index');
});

Route::get('/tambah', function () {
    return view('formtambah');
});

Route::get('/update', function () {
    return view('formupdate');
});

Route::get('/delete', function () {
    return view('formdelete');
});
// Route::get('/pasien', [PatientController::class, 'index'])->name('patients.index');
// Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
// Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
// Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
// Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');
// Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

