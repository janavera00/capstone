<?php

use App\Http\Controllers\ClientController;
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
    return view('dashboard');
});

Route::get('/filing', [FilingController::class, 'show']);
Route::get('/filing/{project}', [FilingController::class, 'showFiles']);
Route::post('/filing/{project}/createFile', [FilingController::class, 'createFile']);
Route::post('/file/update/{file}', [FilingController::class, 'updateFile']);
Route::post('/filing/create', [FilingController::class, 'createProject']);
Route::post('/project/update/{project}', [FilingController::class, 'updateProject']);

Route::get('/scheduling', [TaskController::class, 'show']);
Route::get('/scheduling/{project}', [TaskController::class, 'showProjectTask']);
Route::post('/scheduling/create', [TaskController::class, 'createTask']);
Route::get('/task/{task}', [TaskController::class, 'openTask']);
Route::post('/scheduling/update/{task}', [TaskController::class, 'updateTask']);

Route::get('project/{client}', [ClientController::class, 'showProjects']);
Route::get('project/{client}/{project}', [ClientController::class, 'showProjectDetail']);
Route::post('project/{client}/{project}/submitFile', [ClientController::class, 'submitFile']);
Route::get('schedule/{client}', [ClientController::class, 'showTasks']);

Route::post('/home', function () {
    return view('dashboard');
})->name('login');
