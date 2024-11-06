<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;
    protected $table = 'pedido_item';

    protected $fillable = [
        'pedido_id', 'item_cardapio_id', 'quantidade', 'preco'
    ];

    public function itemCardapio()
    {
        return $this->belongsTo(ItemCardapio::class);
    }

    public function PedidoItemAdicional()
    {
        return $this->belongsTo(PedidoItemAdicional::class);
    }

    public function adicionais()
{
    return $this->hasMany(PedidoItemAdicional::class, 'pedido_item_id');
}

    // public function adicionais()
    // {
    //     return $this->belongsToMany(Adicionais::class, 'pedido_item_adicional', 'pedido_item_id', 'adicional_id')
    //                 ->withPivot('quantidade', 'preco'); // se você precisar dos campos adicionais da tabela pivô
    // }
}
