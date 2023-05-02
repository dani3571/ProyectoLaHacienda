<?php

namespace App\Http\Controllers;

use App\Models\Nosotros;
use Illuminate\Http\Request;

class NosotrosController extends Controller
{
    public function index()
    {
        return view('nosotros.nosotros',compact('nosotros'));
    }
}
