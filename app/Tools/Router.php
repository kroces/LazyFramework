<?php

namespace App\Tools;

use Illuminate\Support\Facades\Route;

class Router{

    public static function validate($path){
        if(!Route::has($path)) return false;
        $routes = Route::getRoutes();
        $route = null;
        $data = [];
        foreach($routes as $iterateRoute){
            if($iterateRoute->getName() == $path){
                $route = $iterateRoute;
                break;
            }
            $data[] = $iterateRoute->getName();
        }
        if(strpos($path,"produccion") !== false){
            //dd([$path, $route, $data]);
        }
        return (auth()->user() && $route != null && (auth()->user()->permiso($route->uri())));
    }

    public static function multiValidate($paths){
        foreach($paths as $path){
            if(Router::validate($path[0])){
                return true;
            }
        }
        return false;
    }

    public static function generarRoutasFormulario($permiso = true){
        $data = [];
        $middlewares = [];
        $routeCollection = Route::getRoutes();

        // dd($routeCollection);
		$skip = 0;
        
		foreach ($routeCollection as $value) {
            // dd($value);
            $puedeTenerPermiso = false;
			$skip++;
			if($skip > 7){
                $middlewares[] = $value->middleware();
                foreach( $value->middleware() as $mid){
                    if($mid == "App\Http\Middleware\PermisosActivos"){
                        $puedeTenerPermiso = true;
                        break;
                    }
                }
                if($puedeTenerPermiso){
                    $route["method"] = $value->methods()[0];
                    $route["bracketPos"] = strpos($value->uri(), "{");

                    if($route["bracketPos"]) 
                        $route["title"] =str_split($value->uri(), $route["bracketPos"])[0];
                    else 
                        $route["title"] = $value->uri();
                    $route["url"] = $value->uri();

                    $route["switch"] = $permiso;

                    $rutasArray = explode("/",$route["url"]);
                    $first = $rutasArray[0];
                    $second = $rutasArray[0];
                    if(sizeof($rutasArray) >= 2){
                        $second = $rutasArray[1];
                    }

                    $data[$first][$second][] = $route;
                }
            }
		}
        return $data;
    }

    public static function generarRoutasJson($permiso = true){
        $arrayPermiso = [];
        foreach (Router::generarRoutasFormulario($permiso) as $name => $cat){
            foreach ($cat as $subcatname=>$subcat){
                foreach ($subcat as $key=>$ruta){
                    $arrayPermiso[$key."_".$name."_".$subcatname]["switch"] = $permiso;
                    $arrayPermiso[$key."_".$name."_".$subcatname]["url"] = $ruta['url'];
                }
            }
        }
        return json_encode(array_values($arrayPermiso));
    }
    
}