<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido'; // Definindo a tabela correta
    protected $fillable = ['cliente_id','endereco_id', 'data_Pedido', 'metdPag', 'status', 'total'];

    /**
     * Relacionamento com o ItemCardapio através da tabela pivô pedido_item.
     */
    public function itens()
    {
        return $this->belongsToMany(ItemCardapio::class, 'pedido_item')
                    ->withPivot('quantidade', 'preco');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }


    /**
     * Relacionamento com Adicionais através da tabela pivô pedido_item.
     */
    // public function adicionais()
    // {
    //     return $this->belongsToMany(Adicionais::class, 'pedido_item')
    //                 ->withPivot('preco');
    // }
}
