<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicionais extends Model
{
    use HasFactory;

    protected $table = 'adicionais';

    protected $fillable = ['nome', 'descricao', 'preco'];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_item')
                    ->withPivot('preco');
    }

    public function itensCardapio()
    {
        return $this->belongsToMany(ItemCardapio::class);
    }
}
