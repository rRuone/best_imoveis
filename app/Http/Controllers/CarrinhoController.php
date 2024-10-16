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

    public function update(Request $request)
    {
        $itemId = $request->input('item_id');
        $action = $request->input('action');
        
        // Recupera o carrinho da sessão
        $carrinho = session()->get('carrinho', []);
        
        // Verifica se o item existe no carrinho
        foreach ($carrinho as &$item) {
            if (isset($item['id']) && $item['id'] == $itemId) {
                // Atualiza a quantidade com base na ação
                if ($action == 'increment') {
                    $item['quantidade']++;
                } elseif ($action == 'decrement' && $item['quantidade'] > 1) {
                    $item['quantidade']--;
                }
                // Atualiza a sessão com o carrinho modificado
                session()->put('carrinho', $carrinho);
                
                // Retorna a nova quantidade para atualizar a interface
                return response()->json(['newQuantity' => $item['quantidade']]);
            }
        }
        
        // Caso o item não seja encontrado, retorna um erro
        return response()->json(['error' => 'Item não encontrado'], 404);
    }


    public function avancar()
    {
        // Verifica se o cliente está logado (presente na sessão)
        $clienteId = session()->get('cliente_id');

        if ($clienteId) {
            // Se o cliente estiver logado, redireciona para o checkout
            return redirect()->route('checkout.index');
        } else {
            // Se o cliente não estiver logado, redireciona para a página de criação de cliente
            return redirect()->route('cliente.create')->with('error', 'Por favor, crie ou faça login para continuar.');
        }
    }


}
