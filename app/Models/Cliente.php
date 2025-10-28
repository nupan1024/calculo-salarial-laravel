<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'cliente';
    public $timestamps = true;

    protected $fillable = [
        'nombre_cliente',
        'direccion'
    ];

    public function facturas(): HasMany
    {
        return $this->hasMany(CabezaFactura::class, 'cliente', 'cliente');
    }
}
