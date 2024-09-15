<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCardapio extends Model
{
    use HasFactory;

    protected $table = 'item_cardapio';

    protected $fillable = ['nome', 'preco', 'descricao', 'categoria_id', 'foto'];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_item')
                    ->withPivot('quantidade', 'preco');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function adicionais()
    {
        return $this->belongsToMany(Adicionais::class, 'pedido_item', 'item_cardapio_id');
    }
}
