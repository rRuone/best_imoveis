<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCardapio extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco', 'categoria', 'foto'];

    public function pedidos(){
        return $this->belongsTo(Pedido::class, 'pedido_item')
                    ->withPivot('quantidade', 'preco')
                    ->withTimestamps();
    }

    public function adicionais(){
        return $this->belongsTo(Adicionais::class, 'adicionais_item_pedido')
                    ->withPivot('quantidade', 'preco')
                    ->withTimestamps();
    }
    




}
