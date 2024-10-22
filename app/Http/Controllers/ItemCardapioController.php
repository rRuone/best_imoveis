<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCardapioRequest;
use App\Models\Adicionais;
use App\Models\Categoria;
use App\Models\ItemCardapio;
use Illuminate\Http\Request;

class ItemCardapioController extends Controller
{
    public function index(){
      
        $itemCardapio = ItemCardapio::orderBy('nome')->get();
       
        return view('itemCardapio.index',['itemCardapio' => $itemCardapio]);
    }


    
    public function show(ItemCardapio $itemCardapio)
    {
        // Carregar adicionais associados ao itemCardapio
        $itemCardapio->load('adicionais');
    
        return view('itemCardapio.show', ['itemCardapio' => $itemCardapio]);
        dd($itemCardapio->adicionais);
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
        $request->validated();
        // Formatar o preço e tratar a imagem
        $preco = str_replace(',', '.', preg_replace('/[^\d.,]/', '', $request->preco));
        if (!is_numeric($preco)) {
            return redirect()->back()->withErrors(['preco' => 'O preço deve ser um valor numérico.']);
        }

        // Armazenar imagem se existir
        $path = $request->hasFile('foto') 
                ? $request->file('foto')->storeAs('public/fotos', time() . '.' . $request->file('foto')->getClientOriginalExtension())
                : null;

        // Criar item no banco
        ItemCardapio::create([
            'nome' => $request->nome,
            'categoria_id' => $request->categoria_id,
            'preco' => number_format($preco, 2, '.', ''),
            'foto' => $path,
        ]);

        return redirect()->route('itemCardapio.index')->with('success', 'Item criado com sucesso.');
    }
    
    
    public function product(ItemCardapio $itemCardapio)
    {
        // Inicializa a variável $adicionais como um array vazio
        $adicionais = [];
    
        // Verifica se a categoria do item é carregada
        if ($itemCardapio->categoria && $itemCardapio->categoria->nome === 'Lanche') {
            // Se for um "Lanche", carrega os adicionais
            $adicionais = Adicionais::all();
        }
    
        // Retorna a view ou realiza outras ações necessárias
        return view('itemCardapio.product', [
            'itemCardapio' => $itemCardapio,
            'adicionais' => $adicionais
        ]);
    }



    public function salvarAdicionais(Request $request, ItemCardapio $itemCardapio)
{
    // Validar os dados do formulário
    $request->validate([
        'adicionais.*' => 'exists:adicionais,id', // Verifica se os IDs dos adicionais existem
    ]);

    // Obter os IDs dos adicionais selecionados
    $adicionaisIds = $request->input('adicionais', []);

    // Recuperar os objetos dos adicionais a partir dos IDs
    $adicionais = Adicionais::whereIn('id', $adicionaisIds)->get();

    // Obter o pedido atual da sessão ou criar um novo array vazio
    $pedido = session()->get('pedido', []);

    // Gerar um novo ID único para o item no pedido (caso queira identificar cada item do pedido individualmente)
    $novoItemId = uniqid(); // Gera um ID único para o item no pedido

    // Adicionar o novo item ao pedido com o objeto ItemCardapio e os objetos Adicionais
    $pedido[$novoItemId] = [
        'item_cardapio' => $itemCardapio, // Salva o objeto completo do ItemCardapio
        'adicionais' => $adicionais // Salva os objetos completos dos adicionais
    ];

    // Atualizar a sessão com os dados do pedido
    session()->put('pedido', $pedido);

    // Redirecionar para a página do carrinho com uma mensagem de sucesso
    return redirect()->route('carrinho.index')->with('success', 'Adicionais adicionados ao pedido com sucesso!');
}


}