<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index()
     {

        // Conta o número de pedidos pendentes e em processo
        $numeroPedidosPendentes = Pedido::where('status', 'pendente')->count();
        $numeroPedidosEmProcesso = Pedido::where('status', 'em_processo')->count();
        $numeroPedidosConcluidos = Pedido::where('status', 'concluido')->count();

        $produtosPendentes = Pedido::where('status', 'pendente')->get();
        $pedidosEmProcesso = Pedido::where('status', 'em_processo')->get();
        $pedidosConcluidos = Pedido::where('status', 'concluido')->get();

         // Adiciona a hora do pedido formatada para cada pedido
         foreach ($produtosPendentes as $pedido) {
            // Assume que `data_pedido` é um campo do tipo datetime no banco de dados
            $pedido->hora = Carbon::parse($pedido->created_at)->format('H:i');
        }
        // Adicione esta linha no controlador antes de passar para a view
        //dd($produtosPendentes);


         return view('admin.pedidos.index', compact('produtosPendentes', 'pedidosEmProcesso',
                    'pedidosConcluidos','numeroPedidosPendentes', 'numeroPedidosEmProcesso', 'numeroPedidosConcluidos'));
     }

     public function historico(Request $request)
    {
        // Inicia a query para pedidos finalizados
        $query = Pedido::where('status', 'finalizado');

        // Filtro por nome do cliente
        if ($request->filled('cliente')) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->cliente . '%');
            });
        }

        // Filtro por número do pedido
        if ($request->filled('pedido_id')) {
            $query->where('id', $request->pedido_id);
        }

        // Filtro por data de finalização
        if ($request->filled('data_finalizacao')) {
            $query->whereDate('updated_at', $request->data_finalizacao);
        }

        // Ordenação dos pedidos finalizados
        $pedidosFinalizados = $query->orderBy('updated_at', 'desc')->get();

        return view('admin.pedidos.historico', compact('pedidosFinalizados'));
    }



}
