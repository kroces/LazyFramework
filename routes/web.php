<?php

use Illuminate\Support\Facades\Route;

Route::any("", function (){
    return view("index");
});

Route::get("menu", [\App\Http\Controllers\SiteController::class, "menuAdministracion"])->name("menu");
Route::prefix("administracion")->name("administracion.")->group(function (){
    Route::get("menu", [\App\Http\Controllers\SiteController::class, "menuAdministracion"])->name("menu");
    Route::prefix("ejemplo")->name("ejemplo.")->group(function (){
        Route::get('', [\App\Http\Controllers\LazyController::class, "index"])->name("admin");
        Route::get('registrar', [\App\Http\Controllers\LazyController::class, "create"])->name("registrar");
        Route::post('registrar', [\App\Http\Controllers\LazyController::class, "store"]);
        Route::get('actualizar/{ejemplo}', [\App\Http\Controllers\LazyController::class, "edit"])->name("actualizar");
        Route::post('actualizar/{ejemplo}', [\App\Http\Controllers\LazyController::class, "update"]);
        Route::get('consultar/{ejemplo}', [\App\Http\Controllers\LazyController::class, "show"])->name("consultar");
        Route::post('delete/{ejemplo}', [\App\Http\Controllers\LazyController::class, "destroy"])->name("borrar");
    });
    Route::prefix("ejemploRelacion")->name("ejemploRelacion.")->group(function (){
        Route::get('', [\App\Http\Controllers\LazyController::class, "index"])->name("admin");
        Route::get('registrar', [\App\Http\Controllers\LazyController::class, "create"])->name("registrar");
        Route::post('registrar', [\App\Http\Controllers\LazyController::class, "store"]);
        Route::get('actualizar/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "edit"])->name("actualizar");
        Route::post('actualizar/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "update"]);
        Route::get('consultar/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "show"])->name("consultar");
        Route::post('delete/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "destroy"])->name("borrar");
    });
});