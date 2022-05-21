<?php

use App\Http\Controllers\FilingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/scheduling/{id}', function ($id) {
    return view('schedDetails');
});
Route::get('/home', function () {
    return view('dashboard');
});

Route::get('/filing', [FilingController::class, 'show']);
Route::get('/filing/{project_id}', [FilingController::class, 'showFiles']);

Route::get('/scheduling', function () {
    return view('scheduling');
});
Route::post('/home', function () {
    return view('dashboard');
})->name('login');
