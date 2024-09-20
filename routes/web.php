<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\PermisosActivos;

Route::any("", function (){
    return view("index");
});

Route::get('login', [\App\Http\Controllers\SiteController::class, "login"])->name("login");
Route::post('login', [\App\Http\Controllers\SiteController::class, "authenticate"]);
Route::post('logout', [\App\Http\Controllers\SiteController::class, "logout"])->name("logout");
Route::get('recovery', [\App\Http\Controllers\SiteController::class, "recovery"])->name("usuario.recuperar");
Route::get('menu', [\App\Http\Controllers\SiteController::class, "menu"])->name("menu");
Route::get('authError', [\App\Http\Controllers\SiteController::class, "authError"])->name("authError");

Route::get("menu", [\App\Http\Controllers\SiteController::class, "menuAdministracion"])->name("menu");
Route::prefix("administracion")->name("administracion.")->group(function (){
    Route::get("menu", [\App\Http\Controllers\SiteController::class, "menuAdministracion"])->name("menu");
    Route::prefix("ejemplo")->name("ejemplo.")->group(function (){
        Route::get('', [\App\Http\Controllers\LazyController::class, "index"])->middleware([PermisosActivos::class])->name("admin");
        Route::get('registrar', [\App\Http\Controllers\LazyController::class, "create"])->middleware([PermisosActivos::class])->name("registrar");
        Route::post('registrar', [\App\Http\Controllers\LazyController::class, "store"]);
        Route::get('actualizar/{ejemplo}', [\App\Http\Controllers\LazyController::class, "edit"])->middleware([PermisosActivos::class])->name("actualizar");
        Route::post('actualizar/{ejemplo}', [\App\Http\Controllers\LazyController::class, "update"]);
        Route::get('consultar/{ejemplo}', [\App\Http\Controllers\LazyController::class, "show"])->middleware([PermisosActivos::class])->name("consultar");
        Route::post('delete/{ejemplo}', [\App\Http\Controllers\LazyController::class, "destroy"])->middleware([PermisosActivos::class])->name("borrar");
    });
    Route::prefix("ejemploRelacion")->name("ejemploRelacion.")->group(function (){
        Route::get('', [\App\Http\Controllers\LazyController::class, "index"])->middleware([PermisosActivos::class])->name("admin");
        Route::get('registrar', [\App\Http\Controllers\LazyController::class, "create"])->middleware([PermisosActivos::class])->name("registrar");
        Route::post('registrar', [\App\Http\Controllers\LazyController::class, "store"]);
        Route::get('actualizar/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "edit"])->middleware([PermisosActivos::class])->name("actualizar");
        Route::post('actualizar/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "update"]);
        Route::get('consultar/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "show"])->middleware([PermisosActivos::class])->name("consultar");
        Route::post('delete/{ejemploRelacion}', [\App\Http\Controllers\LazyController::class, "destroy"])->middleware([PermisosActivos::class])->name("borrar");
    });
    Route::prefix("usuario")->name("usuario.")->group(function (){
        Route::get('', [\App\Http\Controllers\UserController::class, "index"])->middleware([PermisosActivos::class])->name("admin");
        Route::get('registrar', [\App\Http\Controllers\UserController::class, "create"])->middleware([PermisosActivos::class])->name("registrar");
        Route::post('registrar', [\App\Http\Controllers\UserController::class, "store"]);
        Route::get('actualizar/{user}', [\App\Http\Controllers\UserController::class, "edit"])->middleware([PermisosActivos::class])->name("actualizar");
        Route::post('actualizar/{user}', [\App\Http\Controllers\UserController::class, "update"]);
        Route::get('consultar/{user}', [\App\Http\Controllers\UserController::class, "show"])->middleware([PermisosActivos::class])->name("consultar");
        Route::post('delete/{user}', [\App\Http\Controllers\UserController::class, "delete"])->middleware([PermisosActivos::class])->name("borrar");
    });
    Route::prefix("permiso")->name("permiso.")->group(function (){
        Route::get("rol/{rol}", [\App\Http\Controllers\PermisoController::class, "rol"])->middleware([PermisosActivos::class])->name("rol");
        Route::get("actualizar/{usuario}", [\App\Http\Controllers\PermisoController::class, "edit"])->middleware([PermisosActivos::class])->name("actualizar");
        Route::post("actualizar/{usuario}", [\App\Http\Controllers\PermisoController::class, "update"]);
    });
    Route::prefix("rol")->name("rol.")->group(function (){
        Route::get("admin", [\App\Http\Controllers\RolController::class, "index"])->middleware([PermisosActivos::class])->name("admin");
        Route::get("registrar", [\App\Http\Controllers\RolController::class, "create"])->middleware([PermisosActivos::class])->name("registrar");
        Route::post("registrar", [\App\Http\Controllers\RolController::class, "store"]);
        Route::get("consultar/{rol}", [\App\Http\Controllers\RolController::class, "show"])->middleware([PermisosActivos::class])->name("consultar");
        Route::get("actualizar/{rol}", [\App\Http\Controllers\RolController::class, "edit"])->middleware([PermisosActivos::class])->name("actualizar");
        Route::post("actualizar/{rol}", [\App\Http\Controllers\RolController::class, "update"]);
        Route::post("borrar/{rol}", [\App\Http\Controllers\RolController::class, "destroy"])->middleware([PermisosActivos::class])->name("borrar");
    });
});