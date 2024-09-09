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
        return $this->belongsTo(Adicional::class,'item_pedido_adicional')
                    ->withPivot('quantidade','preco')
                    ->withTimestamps();
    }

}
