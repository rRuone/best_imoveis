<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicionais extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'preco'];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'adicionais_item_pedido')
                    ->withPivot('item_cardapio_id', 'preco', 'quantidade');
    }

    public function itensCardapio()
    {
        return $this->belongsToMany(ItemCardapio::class, 'adicionais_item_cardapio', 'adicionais_id', 'item_cardapio_id')
                    ->withPivot('preco', 'quantidade');
    }
}
