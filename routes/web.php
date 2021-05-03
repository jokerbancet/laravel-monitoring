<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\PembimbingIndustriController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemaganganController;
use App\Http\Controllers\IndikatorCapaianController;


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get ('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'CheckRole:admin']], function(){
    //Data Master Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::post('/mahasiswa/create', [MahasiswaController::class, 'create']);
    Route::get('/mahasiswa/{id}/detail', [MahasiswaController::class, 'detail']);
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit']);
    Route::post('/mahasiswa/{id}/update', [MahasiswaController::class, 'update']);
    Route::get('/mahasiswa/{id}/delete', [MahasiswaController::class, 'delete']);

    //Data Master Dosen Pembimbing
    Route::get('/dosenpembimbing', [DosenpembimbingController::class, 'index']);
    Route::post('/dosenpembimbing/create', [DosenpembimbingController::class, 'create']);
    Route::get('/dosenpembimbing/{id}/detail', [DosenpembimbingController::class, 'detail']);
    Route::get('/dosenpembimbing/{id}/edit', [DosenpembimbingController::class, 'edit']);
    Route::post('/dosenpembimbing/{id}/update', [DosenpembimbingController::class, 'update']);
    Route::get('/dosenpembimbing/{id}/delete', [DosenPembimbingController::class, 'delete']);

    //Data Master Pembimbing Industri
    Route::get('/pembimbingindustri', [PembimbingIndustriController::class, 'index']);
    Route::post('/pembimbingindustri/create', [PembimbingIndustriController::class, 'create']);
    Route::get('/pembimbingindustri/{id}/detail', [PembimbingIndustriController::class, 'detail']);
    Route::get('/pembimbingindustri/{id}/edit', [PembimbingIndustriController::class, 'edit']);
    Route::post('/pembimbingindustri/{id}/update', [PembimbingIndustriController::class, 'update']);
    Route::get('/pembimbingindustri/{id}/delete', [PembimbingIndustriController::class, 'delete']);

    //Data Master Industri
    Route::get('/industri', [IndustriController::class, 'index']);
    Route::post('/industri/create', [IndustriController::class, 'create']);
    Route::get('/industri/{id}/edit', [IndustriController::class, 'edit']);
    Route::post('/industri/{id}/update', [IndustriController::class, 'update']);
    Route::get('/industri/{id}/delete', [IndustriController::class, 'delete']);
    // Route::get('/industri/{id}/detail', [IndustriCoqntroller::class, 'detail']);

    //Data Pemagangan
    Route::get('/pemagangan',[PemaganganController::class, 'index']);
    Route::post('/pemagangan/create',[PemaganganController::class, 'create']);

    //Data indikator capaian
    Route::get('/capaian',[IndikatorCapaianController::class, 'index']);
    Route::post('/capaian/create',[IndikatorCapaianController::class, 'create']);
    Route::get('/capaian/{id}/edit',[IndikatorCapaianController::class, 'edit']);
    Route::post('/capaian/{id}/update',[IndikatorCapaianController::class, 'update']);
});

Route::group(['middleware' => ['auth', 'CheckRole:admin,mahasiswa,dosenpembimbing,pembimbingindustri']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
