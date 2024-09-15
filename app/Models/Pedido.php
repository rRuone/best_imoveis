<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido'; // Definindo a tabela correta
    protected $fillable = ['cliente_id', 'data_Pedido', 'metdPag', 'status', 'total'];

    public function itens()
    {
        return $this->belongsToMany(ItemCardapio::class, 'pedido_item')
                    ->withPivot('quantidade', 'preco', 'adicional_id');
    }

    public function adicionais()
    {
        return $this->belongsToMany(Adicionais::class, 'pedido_item')
                    ->withPivot('preco');
    }
}
