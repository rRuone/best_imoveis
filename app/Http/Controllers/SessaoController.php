<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function reiniciarSessao()
    {
        // Destrói a sessão atual
        session()->flush(); // Limpa todas as variáveis da sessão

       

        // Redireciona o usuário para a página inicial (ou qualquer outra página)
        return redirect()->route('home.index')->with('message', 'Sessão reiniciada com sucesso!');
    }
}
