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
    $adicionais = Adicionais::orderBy($sort, $direction)->paginate(10); // Ajuste o número de itens por página conforme necessário

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

    public function store(AdicionalRequest $request){
        $request->validated();

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

        // Processa o campo 'preco' para garantir que esteja em formato correto
        $preco = $request->input('preco');

        // Remove o "R$ " e troca a vírgula por ponto para enviar no formato correto
        $preco = str_replace(['R$', ' ', '.'], ['', '', ''], $preco); // Remove "R$ " e espaços
        $preco = str_replace(',', '.', $preco); // Troca a vírgula por ponto

        // Atualiza os dados do adicional com os dados da requisição
        $adicionais->update(array_merge($request->all(), ['preco' => $preco]));

         // Obtém o parâmetro de ordenação, padrão é 'nome'
    $sort = $request->get('sort', 'nome');

    // Valida o parâmetro de ordenação
    $allowedSorts = ['nome', 'preco'];
    if (!in_array($sort, $allowedSorts)) {
        $sort = 'nome';
    }

    // Busca os adicionais, ordenando pelo campo especificado
    $adicionais = Adicionais::orderBy($sort)->get();

        // Redireciona para a página de listagem com uma mensagem de sucesso
        return redirect()->route('admin.adicionais.index')->with('success', 'Adicional atualizado com sucesso.');
    }




}
