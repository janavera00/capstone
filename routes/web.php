<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FilingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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


Route::post('home', [UserController::class, 'authenticate']);
Route::get('home', [UserController::class, 'authenticate']);

Route::get('/logout', [UserController::class, 'destroy']);
Route::get('/users', [UserController::class, 'show']);
Route::post('/user/create', [UserController::class, 'create']);

Route::get('clients', [FilingController::class, 'show']);
Route::get('updateProject/step/{project}/{stepNo}', [FilingController::class, 'updateStep']);
Route::get('projects/{client}', [FilingController::class, 'showProjects']);
Route::get('projectContent/{project}', [FilingController::class, 'showProjectContent']);
Route::post('project/{project}/createFile', [FilingController::class, 'createFile']);
Route::post('file/update/{file}', [FilingController::class, 'updateFile']);
Route::post('filing/create/{client}', [FilingController::class, 'createProject']);
Route::post('project/update/{project}', [FilingController::class, 'updateProject']);

Route::get('/scheduling', [TaskController::class, 'show']);
Route::get('/scheduling/{project}', [TaskController::class, 'showProjectTask']);
Route::post('scheduling/create/{project?}', [TaskController::class, 'createTask']);
Route::get('task/{task}/{from}', [TaskController::class, 'openTask']);
Route::post('scheduling/update/{task}', [TaskController::class, 'updateTask']);
Route::post('reschedule/{task}', [TaskController::class, 'resched']);
Route::get('deleteTask/{task}', [TaskController::class, 'delete']);

Route::post('/client/create', [ClientController::class, 'create']);
Route::post('client/{client}/update', [ClientController::class, 'update']);
Route::get('project/{client}', [ClientController::class, 'showProjects']);
Route::get('project/{client}/{project}', [ClientController::class, 'showProjectDetail']);
Route::post('project/{client}/{project}/submitFile', [ClientController::class, 'submitFile']);
Route::post('project/{client}/{project}/requestTask', [ClientController::class, 'requestTask']);

Route::post('search', [FilingController::class, 'search']);
Route::get('fileReject/{file}', [FilingController::class, 'reject']);
Route::get('fileAccept/{file}', [FilingController::class, 'accept']);