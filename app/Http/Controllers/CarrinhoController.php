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
        //dd($pedido);
      
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
    $pedido = session()->get('pedido', []);
    $novoPedido = [];

    // Adiciona os itens ao novo pedido sem duplicação
    foreach ($pedido as $item) {
        // Adiciona o item na nova sessão
        $novoPedido[] = $item; // Adiciona o item ao novo pedido
    }

    // Atualiza a sessão com o novo pedido
    session()->put('pedido', $novoPedido);

    // Redireciona conforme a lógica
    $clienteId = session()->get('cliente_id');
    if ($clienteId) {
        return redirect()->route('checkout.index');
    } else {
        return redirect()->route('cliente.create')->with('error', 'Por favor, crie ou faça login para continuar.');
    }
    }



    public function removeCarrinho(Request $request, $index){
        // Recupera o carrinho da sessão
    $pedido = session()->get('pedido', []);

    // Verifica se o item existe no carrinho
    if (isset($pedido[$index])) {
        // Remove o item pelo índice
        unset($pedido[$index]);

        // Reorganiza os índices do array para evitar lacunas
        $pedido = array_values($pedido);

        // Atualiza a sessão com o carrinho atualizado
        session()->put('pedido', $pedido);

        // Redireciona para o carrinho atualizado com mensagem de sucesso
        return redirect()->route('carrinho.index')->with('success', 'Item removido do carrinho com sucesso!');
    }

    // Se o item não for encontrado, redireciona de volta para o carrinho com mensagem de erro
    return redirect()->route('carrinho.index')->with('error', 'Item não encontrado no carrinho.');

    }


}
