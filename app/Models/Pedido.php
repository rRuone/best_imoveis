<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['dataPedido', 'metdPag', 'status'];

    public function itens(){
        return $this->belongsTo(ItemCardapio::class,'pedido_item')
                    ->withPivot('quantidade', 'preco')
                    ->withTimestamps();
    }

    public function adicionais() {
        return $this->belongsTo(Adicionais::class,'adicionais_item_pedido')
                    ->withPivot('quantidade','preco')
                    ->withTimestamps();
    }

}
