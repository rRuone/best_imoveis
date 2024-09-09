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
        return $this->belongsTo(Adicional::class, 'item_pedido_adicional')
                    ->withPivot('quantidade', 'preco')
                    ->withTimestamps();
    }
    




}
