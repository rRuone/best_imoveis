<?php

namespace App\Http\Controllers;

use App\Models\ItemCardapio;
use App\Models\Adicionais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarrinhoController extends Controller
{




    public function index()
    {
         $pedido = session()->get('pedido', []);
        // Retorna a view com os itens no carrinho
        return view('carrinho.index', compact('pedido'));
    }



   public function store(Request $request, $itemCardapioId)
{
    // Recuperar o item do cardápio
    $itemCardapio = ItemCardapio::findOrFail($itemCardapioId);

    // Recuperar os adicionais selecionados
    $adicionaisSelecionados = $request->input('adicionais', []);

    // Criar uma lista de adicionais com os detalhes (nome, preço)
    $adicionais = [];
    if (!empty($adicionaisSelecionados)) {
        $adicionais = $itemCardapio->adicionais()->whereIn('id', $adicionaisSelecionados)->get()->map(function ($adicional) {
            return [
                'id' => $adicional->id,
                'nome' => $adicional->nome,
                'preco' => $adicional->preco,
            ];
        })->toArray();
    }

    // Criar um array de item para o carrinho
    $item = [
        'id' => $itemCardapio->id,
        'nome' => $itemCardapio->nome,
        'preco' => $itemCardapio->preco,
        'quantidade' => $request->input('quantidade', 1),
        'adicionais' => $adicionais, // Adicionais com nome e preço
        'observacoes' => $request->input('observacoes', ''),
    ];

    // Verificar se o carrinho já existe na sessão
    $carrinho = session()->get('carrinho', []);

    // Adicionar o item ao carrinho
    $carrinho[] = $item;
    session()->put('carrinho', $carrinho);

    return redirect()->route('carrinho.index')->with('success', 'Item adicionado ao carrinho.');
}
}
