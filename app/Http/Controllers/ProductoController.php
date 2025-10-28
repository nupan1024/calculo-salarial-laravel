<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductoController extends Controller
{
    public function index(): JsonResponse
    {
        $productos = Producto::orderBy('producto')->get();
        return response()->json($productos);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:150',
            'valor' => 'required|numeric|min:0'
        ]);

        $producto = Producto::create($request->only(['nombre_producto', 'valor']));

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'data' => $producto
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:150',
            'valor' => 'required|numeric|min:0'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->only(['nombre_producto', 'valor']));

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'data' => $producto
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json([
            'message' => 'Producto eliminado exitosamente'
        ]);
    }
}
