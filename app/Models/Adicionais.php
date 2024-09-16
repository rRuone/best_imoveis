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
        return $this->belongsToMany(Pedido::class, 'pedido_item_adicional', 'adicional_id', 'pedido_item_id')
                    ->withPivot('quantidade', 'preco'); // se você precisar dos campos adicionais da tabela pivô
    }
    public function itensCardapio()
    {
        return $this->belongsToMany(ItemCardapio::class);
    }
}
