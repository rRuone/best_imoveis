<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Exibe o checkout
    public function index(Request $request){
        
        // Recupera o pedido salvo na sessão
        $pedido = session()->get('pedido', []);
        $clienteId = session()->get('cliente_id');

        // dd([
        //     'pedido' => $pedido,
        //     'cliente_id' => $clienteId,
        //     'cliente' => $clienteId ? \App\Models\Cliente::find($clienteId) : null
        // ]);

        return view('checkout.index', compact('pedido'));
    }
}
