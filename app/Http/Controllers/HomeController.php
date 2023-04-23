<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        //Obtener los articulos publicos(1)
     
         
        //formas de retornar una vista : with
        //return view('home')->with('articles', $articles);
        //con compat escribiendo directamente las variables a retornar

        return view('home.index');
    }
}