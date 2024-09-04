<?php

use App\Http\Controllers\Equipment\EquipmentController;
use App\Http\Controllers\Equipment\UserManagementController;
use App\Http\Controllers\ProfileController;
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
Route::get('equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('usermanage', [UserManagementController::class, 'index'])->name('UserManagement.index');
Route::post('equipment', [EquipmentController::class, 'store'])->name('equipment.store');
Route::get('/equipment/home', [EquipmentController::class, 'homepage'])->name('equipment.homepage');
Route::get('/equipment/home/{equipments_code}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
Route::put('/equipment/home/{equipments_code}/update', [EquipmentController::class, 'update'])->name('equipment.update');
Route::delete('/equipment/{equipments_code}', [EquipmentController::class, 'destroy'])->name('equipment.delete');

Route::middleware('auth')->group(function () {

    Route::post('import', [Usercontrollerimport::class, 'import'])->name('users.import');
    Route::get('import', [Usercontrollerimport::class, 'create'])->name('usersimport');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
