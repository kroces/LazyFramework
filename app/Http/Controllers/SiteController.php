<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller{

    public function authenticate(Request $request){
		$credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::intended('/');
		}
		return back()->withErrors([
			'error' => 'Correo/Contraseña incorrecta',
		]);
	}

	public function login(){
		return view("global.site.login");
	}

	public function logout(Request $request){
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect('/');
	}

	public function authError(){
		return view("global.site.authError");
	}
	public function menuAdministracion(){
		return view("administracion.menu");
	}


}
