<?php

namespace App\Http\Controllers;

use App\Models\CabezaFactura;
use Illuminate\Http\JsonResponse;

class FacturaController extends Controller
{
    public function index(): JsonResponse
    {
        $facturas = CabezaFactura::with('cliente')->orderBy('numero')->get();
        return response()->json($facturas);
    }

    public function show(string $id): JsonResponse
    {
        $factura = CabezaFactura::with(['cliente', 'detalles.producto'])->findOrFail($id);
        return response()->json($factura);
    }
}
