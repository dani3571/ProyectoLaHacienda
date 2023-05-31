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
        return response()->json($products);
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
