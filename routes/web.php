<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Equipment\EquipmentController;
use App\Http\Controllers\Equipment\EquipmentOneReportController;
use App\Http\Controllers\Equipment\UserManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportPdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontrollerimport;
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
    return view('auth.login');
});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::post('equipment', [EquipmentController::class, 'store'])->name('equipment.store');
    Route::get('/equipment/home/{equipments_code}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::put('/equipment/home/{equipments_code}/update', [EquipmentController::class, 'update'])->name('equipment.update');
    Route::get('/equipment/home/{equipments_code}/delete', [EquipmentController::class, 'destroy'])->name('equipment.delete');
    Route::post('import', [Usercontrollerimport::class, 'import'])->name('users.import');
    Route::get('/equipment/home', [EquipmentController::class, 'homepage'])->name('equipment.homepage');
    Route::get('equipment', [EquipmentController::class, 'index'])->name('equipment.index');
    Route::get('/equipment/search', [EquipmentController::class, 'search'])->name('equipment.search');

    Route::get('/reportoneequipment/index', [EquipmentOneReportController::class, 'index'])->name('generate-pdf.index');
    Route::get('generate-pdf/{id}', [ReportPdfController::class, 'generatePDF'])->name('generate-pdf.generatePDF');
    Route::get('GeneratePDFEquipmentAll', [ReportPdfController::class, 'GeneratePDFEquipmentAll'])->name('generate-pdf.GeneratePDFEquipmentAll');
    Route::get('GeneratePDFEquipmentone/{id}', [ReportPdfController::class, 'GeneratePDFEquipmentone'])->name('generate-pdf.GeneratePDFEquipmentone');
    Route::get('/reportdamaged', [ReportPdfController::class, 'reportpagseDamaged'])->name('generate-pdf.reportdamaged');


    Route::get('/showuser', [UserManagementController::class, 'index'])->name('UserManagement.index');
    Route::get('/showuser/create', [UserManagementController::class, 'create'])->name('UserManagement.create');
    Route::post('/showuser/store', [UserManagementController::class, 'store'])->name('UserManagement.store');
    Route::get('/showuser/{id}', [UserManagementController::class, 'destroy'])->name('UserManagement.destroy');
    Route::get('/showuser/{id}/edit', [UserManagementController::class, 'edit'])->name('UserManagement.edit');
    Route::put('/showuser/{id}/update', [UserManagementController::class, 'update'])->name('UserManagement.update');

    Route::get('/reportpdf', [ReportPdfController::class, 'index'])->name('reportpdf.index');

    Route::get('/dashboardequipment', [DashboardController::class, 'index'])->name('dashboardequipment.index');
    Route::get('/update-chart', [DashboardController::class, 'updateChart'])->name('update.chart');

    Route::get('import', [Usercontrollerimport::class, 'create'])->name('usersimport');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
