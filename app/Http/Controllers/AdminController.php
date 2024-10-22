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


}
