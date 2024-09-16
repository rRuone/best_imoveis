<?php
namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemCardapio;
use Illuminate\Http\Request;

class PedidoController extends Controller
{   
    public function index()
    {
        // Obtém todos os pedidos
        $pedidos = Pedido::all();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show($id)
    {
        // Obtém o pedido específico com suas relações (itens e adicionais)
        $pedido = Pedido::with('itens.itemCardapio.adicionais')->findOrFail($id);
        return view('admin.pedidos.show', compact('pedido'));
    }




    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array',
            'itens.*.id' => 'required|exists:item_cardapio,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.adicionais' => 'nullable|array',
        ]);

        // Criação do pedido
        $pedido = Pedido::create([
            'cliente_id' => $request->cliente_id,
            'data_Pedido' => now(),
            'metdPag' => $request->metdPag,
            'status' => 'pendente',
            'total' => 0, // Será calculado após o loop de itens
        ]);

        $total = 0;

        foreach ($request->itens as $item) {
            $itemCardapio = ItemCardapio::findOrFail($item['id']);
            $quantidade = $item['quantidade'];
            $precoItem = $itemCardapio->preco * $quantidade;
            $total += $precoItem;

            $pedido->itens()->attach($itemCardapio->id, [
                'quantidade' => $quantidade,
                'preco' => $precoItem
            ]);

            // Adicionar adicionais
            if (!empty($item['adicionais'])) {
                foreach ($item['adicionais'] as $adicionalId) {
                    $pedido->adicionais()->attach($adicionalId, [
                        'preco' => ItemCardapio::findOrFail($itemCardapio->id)
                                              ->adicionais()
                                              ->findOrFail($adicionalId)
                                              ->preco
                    ]);
                }
            }
        }

        // Atualizar o total do pedido
        $pedido->update(['total' => $total]);

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso.');
    }
}
