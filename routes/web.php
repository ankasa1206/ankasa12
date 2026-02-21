<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Wali\PendaftaranSantriController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/login-check', function () {
        return redirect('/dashboard');
    })->name('login.redirect');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });
    Route::controller(ChatController::class)->group(function () {
        Route::get('/messages', 'inbox')->name('messages.inbox');
        Route::get('/chat/{receiverId}', 'index')->name('chat.show');
        Route::post('/messages', 'store')->name('messages.store');
    });
});


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/pendaftaran', [AdminController::class, 'index'])->name('pendaftaran');
        Route::get('/santri-aktif', [AdminController::class, 'daftarSantri'])->name('santri.index');
        Route::patch('/santri/{santri}/status', [AdminController::class, 'updateStatus'])->name('santri.update-status');
        Route::resource('santri', AdminController::class)->except(['index']); 
Route::resource('kelas', KelasController::class)->parameters([
    'kelas' => 'kelas'
]);        Route::resource('guru', GuruController::class);
});


Route::middleware(['auth', 'role:wali'])
    ->prefix('wali')
    ->name('wali.')
    ->group(function () {
        
        Route::get('/dashboard', function () {
            return view('wali_santri.dashboard');
        })->name('dashboard');
        Route::get('/santri-saya', [PendaftaranSantriController::class, 'index'])->name('santri.index');
        Route::get('/daftar-santri', [PendaftaranSantriController::class, 'create'])->name('santri.create');
        Route::post('/daftar-santri', [PendaftaranSantriController::class, 'store'])->name('santri.store');
});

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
        
        // Contoh route tambahan untuk guru:
        // Route::get('/nilai', [GuruDashboardController::class, 'nilai'])->name('nilai.index');
        // Route::get('/presensi', [GuruDashboardController::class, 'presensi'])->name('presensi.index');
});

require __DIR__.'/auth.php';