<?php

use App\Http\Controllers\Access\AccessController;
use App\Http\Controllers\Panel\DashboardController;
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

Route::controller(AccessController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/login', 'validateLogin');
    Route::get('/registrar-se', 'signup');
    Route::post('/registrar', 'validateSignup');
});

//Cria o controle das rotas com permissão de acesso
Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/inicio', 'index');
        Route::post('/tarefa/adicionar', 'newTask');
        Route::post('/tarefas/listar', 'listTask');
        Route::post('/tarefas/atualizar', 'updateTask');
        Route::post('/tarefa/carregar', 'loadTask');
    });
});
