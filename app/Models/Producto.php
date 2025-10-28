<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'producto';
    public $timestamps = true;

    protected $fillable = [
        'nombre_producto',
        'valor'
    ];

    protected $casts = [
        'valor' => 'decimal:2'
    ];

    public function detallesFactura(): HasMany
    {
        return $this->hasMany(DetalleFactura::class, 'producto', 'producto');
    }
}
