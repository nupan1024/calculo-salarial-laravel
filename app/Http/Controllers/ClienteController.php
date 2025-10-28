<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClienteController extends Controller
{
    public function index(): JsonResponse
    {
        $clientes = Cliente::orderBy('cliente')->get();
        return response()->json($clientes);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:200'
        ]);

        $cliente = Cliente::create($request->only(['nombre_cliente', 'direccion']));

        return response()->json([
            'message' => 'Cliente creado exitosamente',
            'data' => $cliente
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:200'
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->only(['nombre_cliente', 'direccion']));

        return response()->json([
            'message' => 'Cliente actualizado exitosamente',
            'data' => $cliente
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json([
            'message' => 'Cliente eliminado exitosamente'
        ]);
    }
}
