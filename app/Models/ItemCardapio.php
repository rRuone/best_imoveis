<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCardapio extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco', 'descricao', 'categoria'];

    public function pedidos()
    {
        return $this->hasMany(PedidoItemAdicional::class);
    }
}
