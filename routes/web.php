<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\customerController;

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
Route::middleware(['auth', 'isCustomer'])->group(function () {
    Route::get('/home', [customerController::class, 'home'])->name('home');
    Route::get('/appointment', [customerController::class, 'viewAppointment'])->name('appointment');
    Route::get('/schedule', [customerController::class, 'viewSchedule'])->name('scheduled');
    Route::post('/appointments', [customerController::class, 'store'])->name('appointments.store');


    Route::post('/update-appointment-Canceled', [customerController::class, 'toCanceled']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/viewAppointments', [adminController::class, 'viewAppointments'])->name('viewAppointments');
    Route::post('/appointment/update', [adminController::class, 'update'])->name('update.appointment');
    Route::get('/viewSchedule', [adminController::class, 'viewSchedule'])->name('viewSchedule');
    Route::get('/viewRooms', [adminController::class, 'viewRooms'])->name('viewRooms');
    Route::get('/viewServices', [adminController::class, 'viewServices'])->name('viewServices');

    Route::post('/update-appointment-toDone', [adminController::class, 'toDone']);
    Route::post('/update-appointment-toCanceled', [adminController::class, 'toCanceled']);

    Route::delete('/room/{doctor}', [adminController::class, 'destroy'])->name('room.destroy');
    Route::post('/room-doctor', [adminController::class, 'store'])->name('room.add');
    Route::post('/update-room', [adminController::class, 'updateRoom']);

    Route::delete('/service/{doctor}', [adminController::class, 'destroyservice'])->name('service.destroy');
    Route::post('/service-doctor', [adminController::class, 'storeservice'])->name('service.add');
    Route::post('/update-service', [adminController::class, 'updateservice']);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user(); // Get the authenticated user
    
    if ($user->role === 'admin') {
        return redirect()->route('viewAppointments'); // Redirect to admin's appointments page
    } elseif ($user->role === 'customer') {
        return redirect()->route('home'); // Redirect to patient's appointment page
    }

    // Default fallback if no role matches
    abort(403, 'Unauthorized action.');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
