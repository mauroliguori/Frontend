<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/tareas", function () {
    return view("crearTarea");
});
Route::post("/tareas",[TareaController::class,"Crear"]);

Route::get("/tareas",[TareaController::class,"Listar"]);

Route::get("/tareas/{d}",[TareaController::class,"Obtener"]);
Route::get("/eliminarTareas/{d}",[TareaController::class,'Eliminar']);
Route::post("/login",[UsuarioController::class,"Login"]);
Route::get("/login", function () {
    return view("login");
});