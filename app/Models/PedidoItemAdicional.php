<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItemAdicional extends Model
{
    use HasFactory;
    protected $fillable = ['pedido_id', 'item_cardapio_id', 'adicional_id', 'quantidade', 'preco'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function itemCardapio()
    {
        return $this->belongsTo(ItemCardapio::class, 'item_cardapio_id');
    }

    public function adicional()
    {
        return $this->belongsTo(Adicional::class);
    }
}
