<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItemAdicional extends Model
{
    use HasFactory;

    protected $table = 'pedido_item_adicional';

    protected $fillable = [
        'pedido_item_id',
        'adicional_id',
        'quantidade',
        'preco',
    ];

    // Relacionamento com PedidoItem
    public function pedidoItem()
    {
        return $this->belongsTo(PedidoItem::class, 'pedido_item_id');
    }

    // Relacionamento com Adicional
    public function adicional()
    {
        return $this->belongsTo(Adicionais::class, 'adicional_id');
    }
}
