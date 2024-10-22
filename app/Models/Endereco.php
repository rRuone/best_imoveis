<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

    use HasFactory;
    protected $table = 'enderecos';

    // Campos que podem ser atribuídos em massa
    protected $fillable = [
        'cliente_id',   // Adiciona cliente_id aqui
        'cidades_id',
        'logradouro',
        'bairro',
        'complemento'
    ];
    
    public function cliente(){
        return $this->belongsTo((Cliente::class));
    }
    public function cidade(){
        return $this->belongsTo((Cidade::class));
    }
}
