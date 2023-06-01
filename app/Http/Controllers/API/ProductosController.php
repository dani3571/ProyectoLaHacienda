<?php

namespace App\Http\Controllers\API;

use App\Models\Productos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $products = Productos::all();
        return response()->json($products, 200);
    }
}
