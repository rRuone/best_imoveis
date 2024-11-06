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
    // Modelo Pedido
    public function pedidoItems()
{
    return $this->hasMany(PedidoItem::class, 'pedido_id');
}


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function adicionais()
    {
        return $this->hasManyThrough(
            Adicionais::class,
            PedidoItemAdicional::class,
            'pedido_item_id', // Chave estrangeira da tabela pivô
            'id', // Chave estrangeira da tabela adicionais
            'id', // Chave primária da tabela pedido
            'adicional_id' // Chave que conecta a tabela pivô com a tabela adicionais
        );
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
