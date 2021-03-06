<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\PembimbingIndustriController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemaganganController;
use App\Http\Controllers\IndikatorCapaianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RelasiCapaianController;
use App\Http\Controllers\DataLaporanController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgot-password', [AuthController::class, 'forgot'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'forgot_submit'])->name('forgot.password.post');
Route::view('/password/reset', 'auths.password-reset')->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'reset']);
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get ('/logout', [AuthController::class, 'logout']);

Route::group(['middleware'=>['auth']],function(){
    Route::get('/dashboard',[DashboardController::class, 'index']);
    Route::get('/ganti-password', [ProfileController::class, 'index']);
    Route::put('/ganti-password', [ProfileController::class, 'password']);
});

Route::group(['middleware' => ['auth', 'CheckRole:admin']], function(){
    //Data Master Mahasiswa
    Route::post('/mahasiswa/excel', [AdminController::class, 'excel_mahasiswa']);

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

    Route::resource('hrd', HrdController::class);

    //Data Master Industri
    Route::get('/industri', [IndustriController::class, 'index']);
    Route::post('/industri/create', [IndustriController::class, 'create']);
    Route::get('/industri/{id}/edit', [IndustriController::class, 'edit']);
    Route::post('/industri/{id}/update', [IndustriController::class, 'update']);
    Route::get('/industri/{id}/delete', [IndustriController::class, 'delete']);

    //Data indikator capaian
    Route::get('/capaian',[IndikatorCapaianController::class, 'index']);
    Route::post('/capaian/create',[IndikatorCapaianController::class, 'create']);
    Route::get('/capaian/{id}/edit',[IndikatorCapaianController::class, 'edit']);
    Route::post('/capaian/{id}/update',[IndikatorCapaianController::class, 'update']);
    Route::get('/capaian/{id}/delete',[IndikatorCapaianController::class, 'delete']);

    // Relasi KK
    Route::put('/rel_capaian/batch-export',[RelasiCapaianController::class, 'batch_export']);

    //Data Laporan mahasiswa
    Route::post('/inputlaporan/excel', [AdminController::class, 'excel_laporan']);

    Route::get('activity-log', [AdminController::class, 'activity_log']);
    Route::resource('user', UserController::class);
    Route::put('/user/{user}/reset-password', [UserController::class, 'reset_password']);
});

Route::middleware(['auth','CheckRole:admin,Kaprodi*,Direktur'])->group(function(){
    Route::get('/data-statistik', [AdminController::class, 'data_statistik']);
    Route::get('data-statistik-ajax', [AdminController::class, 'api_data_statistik']);
});

Route::get('/capaian/{mahasiswa?}', [IndikatorCapaianController::class, 'show']);

Route::group(['middleware' => ['auth', 'CheckRole:admin,dosenpembimbing,pembimbingindustri']], function(){
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/persetujuan', [PersetujuanController::class, 'index']);
    Route::get('/persetujuan/mhs/{mahasiswa}', [PersetujuanController::class, 'mahasiswa']);
    Route::get('/histori-approval', [PersetujuanController::class, 'index']);
    Route::get('/histori-approval/{mahasiswa}', [PersetujuanController::class, 'histori_approval']);
    Route::get('/persetujuan/{laporan}', [PersetujuanController::class, 'show']);
    Route::post('/persetujuan/{laporan}/approve', [PersetujuanController::class, 'approve']);
    Route::get('/data-bimbingan', [MahasiswaController::class, 'dataBimbingan']);
    Route::get('/data-bimbingan/{mahasiswa}/detail', [MahasiswaController::class, 'detail_bimbingan']);
    Route::get('/data-bimbingan/{pemagang}/print',[RelasiCapaianController::class, 'print']);
    Route::get('/rekap-laporan', [PersetujuanController::class, 'rekap']);
    Route::get('/rekap-laporan/{mahasiswa}', [PersetujuanController::class, 'rekap_show']);
});

Route::group(['middleware' => ['auth', 'CheckRole:mahasiswa']], function(){
    //laporan
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit']);
    Route::put('/laporan/{laporan}/edit', [LaporanController::class, 'update']);
    Route::post('/laporan/create', [LaporanController::class, 'create']);
    Route::post('/laporan/lupa', [LaporanController::class, 'lupa']);
    Route::get('/histori-laporan', [LaporanController::class, 'history']);
    Route::get('/absen-ku', [MahasiswaController::class, 'absen']);
    Route::get('/lupa-laporan', [LaporanController::class, 'index']);

    // Check default password
});
Route::get('/check-password', [UserController::class, 'check_password']);

// Route::group(['middleware'=>['auth', 'CheckRole:admin,Admin Teknologi Geologi,Admin Teknologi Pertambangan,Admin Teknologi Metalurgi']], function(){
Route::group(['middleware'=>['auth', 'CheckRole:admin,Admin*,Kaprodi*,Direktur']], function(){
    // Data Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/trash', [MahasiswaController::class, 'trash']);
    Route::post('/mahasiswa/create', [MahasiswaController::class, 'create']);
    Route::get('/mahasiswa/{id}/detail', [MahasiswaController::class, 'detail']);
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit']);
    Route::post('/mahasiswa/{id}/update', [MahasiswaController::class, 'update']);
    Route::get('/mahasiswa/{id}/delete', [MahasiswaController::class, 'delete']);
    Route::get('/mahasiswa/{id}/restore', [MahasiswaController::class, 'restore']);
    Route::delete('/mahasiswa/delete-selected', [MahasiswaController::class, 'delete_selected']);
    Route::patch('/mahasiswa/restore-selected', [MahasiswaController::class, 'restore_selected']);

    // Pemagangan
    Route::get('/pemagangan',[PemaganganController::class, 'index']);
    Route::post('/pemagangan/create',[PemaganganController::class, 'create']);
    Route::get('/pemagangan/{pemagang}', [PemaganganController::class, 'show']);
    Route::get('/pemagangan/{pemagang}/edit', [PemaganganController::class, 'edit']);
    Route::put('/pemagangan/{pemagang}/update', [PemaganganController::class, 'update']);
    Route::get('/pemagangan/{id}/delete', [PemaganganController::class, 'delete']);

    // Data Relasi Capaian
    Route::get('/rel_capaian',[RelasiCapaianController::class, 'index']);
    Route::get('/rel_capaian/{pemagang}',[RelasiCapaianController::class, 'show']);
    Route::get('/rel_capaian/{pemagang}/print',[RelasiCapaianController::class, 'print']);

    // Data Laporan
    Route::get('/datalaporan',[DataLaporanController::class, 'index']);
    Route::get('/datalaporan-ajax', [DataLaporanController::class, 'ajax']);
    Route::get('/inputlaporan', [DataLaporanController::class, 'create']);
    Route::post('/inputlaporan', [DataLaporanController::class, 'store']);
});
