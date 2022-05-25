<?php

use App\Http\Controllers\FilingController;
use App\Http\Controllers\TaskController;
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

Route::get('/home', function () {
    return view('office/dashboard');
});

Route::get('/filing', [FilingController::class, 'show']);
Route::get('/filing/{project}', [FilingController::class, 'showFiles']);
Route::post('/filing/{project}/createFile', [FilingController::class, 'createFile']);
Route::post('/filing/{file}/updateFile', [FilingController::class, 'updateFile']);
Route::post('/filing/create', [FilingController::class, 'createProject']);
Route::post('/project/update/{project}', [FilingController::class, 'updateProject']);
Route::post('/project/{project}/confirmPass', [FilingController::class, 'confirmPass']);

Route::get('/scheduling', [TaskController::class, 'show']);
Route::post('/scheduling/create', [TaskController::class, 'createTask']);
Route::get('/scheduling/{task}', [TaskController::class, 'openTask']);
Route::post('/scheduling/update/{task}', [TaskController::class, 'updateTask']);

Route::post('/home', function () {
    return view('office/dashboard');
})->name('login');
