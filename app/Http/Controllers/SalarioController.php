<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SalarioController extends Controller
{
    private const TARIFA_NORMAL = 25000; // hasta 48 horas
    private const TARIFA_EXTRA = 35000;  // más de 48 horas
    private const LIMITE_NORMAL = 48;

    public function calcular(Request $request): JsonResponse
    {
        $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,cliente',
            'horas' => 'required|integer|min:0'
        ]);

        $cliente = \App\Models\Cliente::findOrFail($request->input('cliente_id'));
        $horas = $request->input('horas');

        $resultado = $this->calcularSalario($cliente->nombre_cliente, $horas);

        return response()->json($resultado);
    }

    private function calcularSalario(string $nombre, int $horas): array
    {
        if ($horas < 0) {
            throw new \InvalidArgumentException('Las horas no pueden ser negativas.');
        }

        $horasNormales = $horas;
        $horasExtras = 0;

        if ($horas > self::LIMITE_NORMAL) {
            $horasNormales = self::LIMITE_NORMAL;
            $horasExtras = $horas - self::LIMITE_NORMAL;
        }

        $total = ($horasNormales * self::TARIFA_NORMAL) + ($horasExtras * self::TARIFA_EXTRA);

        return [
            'nombre_empleado' => $nombre,
            'horas_trabajadas' => $horas,
            'salario' => $total,
            'mensaje' => "Al Empleado {$nombre} se le debe pagar la suma de " . number_format($total, 0, ',', '.') . " pesos."
        ];
    }
}
