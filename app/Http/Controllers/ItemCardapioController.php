<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCardapioRequest;
use App\Models\Categoria;
use App\Models\ItemCardapio;
use Illuminate\Http\Request;

class ItemCardapioController extends Controller
{
    public function index(){
      
        $itemCardapio = ItemCardapio::orderBy('nome')->get();
       
        return view('itemCardapio.index',['itemCardapio' => $itemCardapio]);
    }

     // Detalhes de Item Categoria
     public function show(ItemCardapio $itemCardapio){
        return view('itemCardapio.show',['itemCardapio' =>$itemCardapio]);
    }

    public function create()
    {
        // Obter todas as categorias para popular o select
        $categorias = Categoria::all();

        // Retornar a visualização com as categorias
        return view('itemCardapio.create', compact('categorias'));
    }


    public function store(ItemCardapioRequest $request)
    {
        // Obter o valor do preço
        $preco = $request->preco;
    
        // Remover caracteres não numéricos, mantendo apenas ponto para decimais
        $precoNumerico = preg_replace('/[^\d.,]/', '', $preco);
    
        // Substituir vírgula por ponto (para conformidade com o formato numérico dos EUA)
        $precoNumerico = str_replace(',', '.', $precoNumerico);
    
        // Verificar se o valor é numérico e formatar para dois decimais
        if (!is_numeric($precoNumerico)) {
            return redirect()->back()->withErrors(['preco' => 'O preço deve ser um valor numérico.']);
        }
    
        $precoFormatado = number_format((float)$precoNumerico, 2, '.', '');
    
        // Verificar se o campo foto foi preenchido
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Nome único para o arquivo
            $path = $file->storeAs('public/fotos', $filename); // Armazenar no diretório public/fotos
        } else {
            $path = null; // Caso não haja foto
        }
    
        // Criar o item no banco de dados
        ItemCardapio::create([
            'nome' => $request->nome,
            'categoria_id' => $request->categoria_id,
            'preco' => $precoFormatado, // Salvar o preço formatado
            'foto' => $path, // Salvar o caminho da imagem no banco
        ]);
    
        return redirect()->route('itemCardapio.index')->with('success', 'Item criado com sucesso.');
    }

}
