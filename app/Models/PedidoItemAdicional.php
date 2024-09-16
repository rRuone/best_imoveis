<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItemAdicional extends Model
{
    use HasFactory;

    protected $table = 'pedido_item_adicional';

    // Define os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'pedido_item_id',
        'adicional_id',
        'quantidade',
        'preco',
    ];

    // Desativa a auto-incrementação, pois a chave primária não é auto-incrementada
    public $incrementing = false;

    // Desativa o uso de timestamps
    public $timestamps = false;

    // Define a chave primária como composta, se necessário
    protected $primaryKey = ['pedido_item_id', 'adicional_id'];

    // Método para definir a chave primária composta
    public function getKeyName()
    {
        return 'pedido_item_id'; // Usado pelo Eloquent para operações de consulta
    }

    // Relacionamento com PedidoItem
    public function pedidoItem()
    {
        return $this->belongsTo(PedidoItem::class, 'pedido_item_id');
    }

    // Relacionamento com Adicional
    public function adicional()
    {
        return $this->belongsTo(Adicionais::class, 'adicional_id');
    }

    // Define uma função para obter o nome da chave primária composta
    public function getKeyType()
    {
        return 'string'; // Defina 'string' ou 'int' com base no tipo da sua chave primária
    }
}
