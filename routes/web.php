<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrutaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/crearFruta", function () {
    return view("crearFruta");
});
Route::post("/crearFruta",[FrutaController::class,"Crear"]);

Route::get("/frutas",[FrutaController::class,"Listar"]);
Route::get("/fruta/{d}",[FrutaController::class,"Obtener"]);
Route::get("/eliminarFruta/{d}",[FrutaController::class,'Eliminar']);