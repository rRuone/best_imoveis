<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Http\Requests\CidadeRequest;

class CidadesController extends Controller
{
    public function cidades(){

        $subtitulo = 'Lista de Cidades';

        // $cidades = ['Belo', 'Recife','Castro'];
            // $cidades = [];

            $cidades = Cidade::all();//busca a tabela que esta associada a esse modelo, é como um select no mysql

        return view('admin.cidades.index', compact('subtitulo', 'cidades'));
    }

    public function formAdicionar() {

        return view('admin.cidades.form') ;

    }

    public function adicionar(CidadeRequest $request){

        // $nome = $request->input('nome');
        //Criar um objeto do modelo (classe) CIdade

        // $cidade = new Cidade();
        // $cidade->nome = $request ->nome;
        // $cidade->save(); //salvar no banco de

        //validar esses dados
        // $request->validate([
        //     'nome'=> 'bail|required|min:3|max:100|unique:cidades' //obrigatorio
        // ]);

        //Com atribuição em massa
        Cidade::create($request->all());

        $request->session()->flash('sucesso', "Cidade $request->nome incluída com sucesso");

        return redirect()->route('admin.cidades.listar');






    }

    public function deletar($id, Request $request){

        Cidade::destroy($id);
        $request->session()->flash('sucesso', "Cidade excluída com sucesso");

        return redirect()->route('admin.cidades.listar');



    }
}
