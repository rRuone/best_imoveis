<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;
    protected $table = 'pedido_item';

    protected $fillable = [
        'pedido_id', 'item_cardapio_id', 'adicional_id', 'quantidade', 'preco'
    ];

    public function itemCardapio()
    {
        return $this->belongsTo(ItemCardapio::class);
    }

    public function adicional()
    {
        return $this->belongsTo(Adicionais::class, 'adicional_id');
    }
}
