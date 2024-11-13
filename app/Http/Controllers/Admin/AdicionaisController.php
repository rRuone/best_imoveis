<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdicionalRequest;
use App\Models\Adicionais;
use Illuminate\Http\Request;

class AdicionaisController extends Controller
{
    public function index(Request $request)
{
    $sort = $request->get('sort', 'nome'); // Define 'nome' como valor padrão
    $direction = $request->get('direction', 'asc'); // Define 'asc' como valor padrão

    // Valida o direction para ser apenas 'asc' ou 'desc'
    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc'; // Redefine para 'asc' se o valor não for válido
    }

    // Busca os adicionais com a ordenação desejada
    $adicionais = Adicionais::orderBy($sort, $direction)->get(); // Ajuste o número de itens por página conforme necessário

    return view('admin.adicionais.index', compact('adicionais', 'sort', 'direction'));
}


    // Detalhes de Adicionais
    public function show($id)
{
    $adicional = Adicionais::findOrFail($id);
    return view('admin.adicionais.show', compact('adicional'));
}

    public function create(){
        return view('admin.adicionais.create');
    }
    public function store(AdicionalRequest $request)
    {
        // Validação dos dados recebidos, incluindo a verificação de unicidade
        $request->validate([
            'nome' => 'required|string|max:255|unique:adicionais,nome', // Verifica se o nome já existe
            'preco' => 'numeric|nullable', // Supondo que você já tenha isso
        ], [
            'nome.unique' => 'Esse adicional já foi cadastrado. Por favor, insira um nome diferente.', // Mensagem personalizada
        ]);

        // Validação já realizada pelo AdicionalRequest
        $request->validated();

        // Criação do adicional
        Adicionais::create($request->all());
        return redirect()->route('admin.adicionais.index')
            ->with('success', 'Adicional cadastrado com sucesso');
    }



    public function destroy(Adicionais $adicionais)
{
    // Delete the adicional from storage
    $adicionais->delete();

    // Redirect back to the index page with a success message
    return redirect()->route('admin.adicionais.index')->with('success', 'Adicional deletado com sucesso.');
}

public function edit($id)
    {
        $adicionais = Adicionais::findOrFail($id);
        return view('admin.adicionais.edit', compact('adicionais'));
    }


    public function update(AdicionalRequest $request, $id)
{
    // Valida os dados da requisição usando o AdicionalRequest
    $request->validated();

    // Busca o item adicional específico pelo ID
    $adicionais = Adicionais::findOrFail($id);

    // Validação para garantir que o nome seja único, exceto para o registro atual
    $request->validate([
        'nome' => 'required|string|max:255|unique:adicionais,nome,' . $adicionais->id,
    ], [
        'nome.unique' => 'Esse adicional já foi cadastrado. Por favor, insira um nome diferente.',
    ]);

    // Processa o campo 'preco' se ele não for vazio
    $preco = $request->input('preco');
    if (!empty($preco)) {
        $preco = str_replace(['R$', ' ', '.'], ['', '', ''], $preco); // Remove "R$ " e espaços
        $preco = str_replace(',', '.', $preco); // Troca a vírgula por ponto
    } else {
        $preco = null; // Define como null se estiver vazio
    }

    // Atualiza os dados do adicional com os dados da requisição
    $adicionais->update(array_merge($request->all(), ['preco' => $preco]));

    // Redireciona para a página de listagem com uma mensagem de sucesso
    return redirect()->route('admin.adicionais.index')->with('success', 'Adicional atualizado com sucesso.');
}





}
