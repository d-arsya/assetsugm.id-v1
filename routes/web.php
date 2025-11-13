<?php

use App\Http\Controllers\dataDokumentasiController;
use App\Http\Controllers\dataMahasiswaController;
use App\Http\Controllers\dataKabinetController;
use App\Http\Controllers\dataDivisiController;
use App\Http\Controllers\dataColorPalleteController;
use App\Http\Controllers\dataStaffController;
use App\Http\Controllers\dataProkerController;
use App\Http\Controllers\ProkerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\dataAspirasiController;
use App\Http\Controllers\KabinetController;
use App\Http\Controllers\PemiraController;
use App\Mail\VoteToken;
use App\Models\Voter;
use Illuminate\Support\Facades\Mail;

Route::get('send-mail', function () {
    $voters = Voter::all();
    foreach ($voters as $voter) {
        Mail::to($voter->email)->send(new VoteToken($voter->code, $voter->name));
        Mail::to($voter->email)->send(new VoteToken($voter->code, $voter->name));
        Mail::to($voter->email)->send(new VoteToken($voter->code, $voter->name));
    }
});
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cabinet/{id}', [KabinetController::class, 'show'])->name('kabinet.show');
Route::get('/cabinet/{id}/structure', [KabinetController::class, 'strukturKabinet'])->name('kabinet.struktur');

Route::get('/program/{id}', [ProkerController::class, 'detailProker'])->name('proker.show');

Route::get('/article', [ArtikelController::class, 'index'])->name('artikel');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::post('/aspirasi/store', [AboutController::class, 'store'])->name('aspirasi.store');

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
    Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
    Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
        Route::get('pemira', [PemiraController::class, 'pemira'])->name('pemira');
        Route::get('pemira/create', [PemiraController::class, 'create'])->name('pemira.create');
        Route::post('pemira', [PemiraController::class, 'store'])->name('pemira.store');
        Route::resource('student', dataMahasiswaController::class)->only(['index', 'store', 'update', 'destroy'])->names('datamahasiswa');
        Route::resource('cabinet', dataKabinetController::class)->only(['index', 'store', 'update', 'destroy'])->names('datakabinet');
        Route::resource('division', dataDivisiController::class)->only(['index', 'store', 'update', 'destroy'])->names('datadivisi');
        Route::resource('pallete', dataColorPalleteController::class)->only(['index', 'store', 'update', 'destroy'])->names('datacolorpallete');
        Route::resource('staff', dataStaffController::class)->only(['index', 'store', 'update', 'destroy'])->names('datastaff');
        Route::resource('program', dataProkerController::class)->only(['index', 'store', 'update', 'destroy'])->names('dataproker');
        Route::resource('documentation', dataDokumentasiController::class)->only(['index', 'store', 'update', 'destroy'])->names('datadokumentasi');
        Route::resource('aspirasi', dataAspirasiController::class)->only(['index', 'destroy'])->names('aspirasi');
        Route::get('mahasiswa/search', [dataStaffController::class, 'search'])->name('mahasiswa.search');
        Route::post('get-divisi', [dataStaffController::class, 'getDivisi'])->name('get.divisi');
        Route::post('get-proker', [dataProkerController::class, 'getProker'])->name('get.proker');
    });
});
