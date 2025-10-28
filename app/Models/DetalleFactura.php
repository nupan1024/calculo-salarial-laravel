<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleFactura extends Model
{
    protected $table = 'detalle_factura';
    public $timestamps = true;

    protected $fillable = [
        'numero',
        'producto',
        'cantidad',
        'valor'
    ];

    protected $casts = [
        'valor' => 'decimal:2'
    ];

    public function factura(): BelongsTo
    {
        return $this->belongsTo(CabezaFactura::class, 'numero', 'numero');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto', 'producto');
    }
}
