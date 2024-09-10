<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicionais extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'preco'];

    public function pedidos(){
        return $this->belongsTo(Pedido::class, 'adicionais_item_pedido')
                    ->withPivot('quantidade', 'preco')
                    ->withTimestamps();
    }

    public function itens(){
        return $this->belongsTo(ItemCardapio::class, 'adicionais_item_pedido')
                    ->withPivot('quantidade', 'preco')
                    ->withTimestamps();
    }
}
