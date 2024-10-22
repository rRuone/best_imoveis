<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdicionalRequest;
use App\Models\Adicionais;
use Illuminate\Http\Request;

class AdicionaisController extends Controller
{
    public function index(){
      
        $adicionais = Adicionais::orderBy('nome')->get();
       
        return view('admin.adicionais.index',['adicionais' => $adicionais]);
    }

    // Detalhes de Adicionais
    public function show(Adicionais $adicionais){
        return view('admin.adicionais.show',['adicionais' =>$adicionais]);
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
}
