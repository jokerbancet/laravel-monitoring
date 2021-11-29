<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('data-statistik', [AdminController::class, 'api_data_statistik']);
Route::get('data-dosen', [AdminController::class, 'data_dosen']);
Route::get('data-pembimbing', [AdminController::class, 'data_pembimbing']);

Route::post('/set-enable-laporan', function (Request $request) {
    DB::table('settings')->where('key', 'laporan_weekend')->update(['value'=>json_encode($request->only('is_enabled'))]);
});
