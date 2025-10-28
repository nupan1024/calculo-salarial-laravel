<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CabezaFactura extends Model
{
    protected $table = 'cabeza_factura';
    protected $primaryKey = 'numero';
    public $timestamps = true;

    protected $fillable = [
        'fecha',
        'cliente',
        'total'
    ];

    protected $casts = [
        'fecha' => 'date',
        'total' => 'decimal:2'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente', 'cliente');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleFactura::class, 'numero', 'numero');
    }
}
