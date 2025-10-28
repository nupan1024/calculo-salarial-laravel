<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ciudades = ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Bucaramanga', 'Cartagena', 'Pereira', 'Santa Marta'];
        $tiposCalle = ['Calle', 'Carrera', 'Avenida', 'Diagonal', 'Transversal'];

        $ciudad = fake()->randomElement($ciudades);
        $tipoCalle = fake()->randomElement($tiposCalle);
        $numero1 = fake()->numberBetween(1, 200);
        $numero2 = fake()->numberBetween(1, 200);
        $numero3 = fake()->numberBetween(1, 200);

        return [
            'nombre_cliente' => fake()->name(),
            'direccion' => "{$tipoCalle} {$numero1} #{$numero2}-{$numero3}, {$ciudad}"
        ];
    }
}
