<?php

use App\Http\Controllers\Admin\AdicionaisController;
use App\Http\Controllers\Admin\CategoriasController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CidadesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCardapioController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/', [HomeController::class, 'index'])->name('home.index'); 

Route::get('/admin/index-cidade',[CidadesController::class,'cidades'])->name('cidades.index');

//Usa-se esse prefixo pra agrupar as rotas que tem admin em comum
Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/cidades',[CidadesController::class, 'cidades'] )->name('cidades.listar');

    Route::get('/cidades/salvar',[CidadesController::class, 'formAdicionar'] )->name('cidades.form');
    Route::post('/cidades/salvar',[CidadesController::class, 'adicionar'] )->name('cidades.adicionar');

    //Adicional 
    Route::get('/index-adicionais',[AdicionaisController::class, 'index'])->name('adicionais.index');
    Route::get('/create-adicionais',[AdicionaisController::class, 'create'])->name('adicionais.create');
    Route::post('/store-adicionais',[AdicionaisController::class, 'store'])->name('adicionais.store');
    Route::get('/show-adicionais/{adicionais}',[AdicionaisController::class, 'show'])->name('adicionais.show');
    Route::get('/edit-adicionais/{adicionais}',[AdicionaisController::class, 'edit'])->name('adicionais.edit');
    Route::put('/update-adicionais/{adicionais}',[AdicionaisController::class, 'update'])->name('adicionais.update');
    Route::delete('/destroy-adicionais/{adicionais}',[AdicionaisController::class, 'destroy'])->name('adicionais.destroy');

    //Categorias
    Route::get('/index-categorias',[CategoriasController::class,'index'])->name('categorias.index');
    Route::get('/create-categorias',[CategoriasController::class,'create'])->name('categorias.create');
    Route::post('/store-categorias',[CategoriasController::class,'store'])->name('categorias.store');
    Route::get('/show-categorias/{categorias}',[CategoriasController::class,'show'])->name('categorias.show');
    Route::get('/edit-categorias/{categorias}',[CategoriasController::class,'edit'])->name('categorias.edit');
    Route::put('/update-categorias/{categorias}',[CategoriasController::class,'update'])->name('categorias.update');
    Route::delete('/destroy-categorias/{categorias}',[CategoriasController::class,'destroy'])->name('categorias.destroy');


}
);

//Clientes 
Route::get('/index-cliente', [ClientesController::class, 'index'])->name('cliente.index');
Route::get('/create-cliente',[ClientesController::class,'create'])->name('cliente.create');
Route::post('/store-cliente',[ClientesController::class,'store'])->name('cliente.store');
Route::post('/show-cliente/{cliente}',[ClientesController::class,'show'])->name('cliente.show');

//ItemCardapio
Route::get('/index-itemCardapio',[ItemCardapioController::class,'index'])->name('itemCardapio.index');
Route::get('/create-itemCardapio',[ItemCardapioController::class,'create'])->name('itemCardapio.create');
Route::post('/store-itemCardapio',[ItemCardapioController::class,'store'])->name('itemCardapio.store');
Route::get('/show-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'show'])->name('itemCardapio.show');
Route::get('/edit-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'edit'])->name('itemCardapio.edit');
Route::put('/show-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'update'])->name('itemCardapio.update');
Route::delete('/destroy-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'destroy'])->name('itemCardapio.destroy');

Route::get('itemCardapio/{itemCardapio}/product', [ItemCardapioController::class, 'product'])->name('itemCardapio.product');

Route::post('itemCardapio/{itemCardapio}/salvar-adicionais', [ItemCardapioController::class, 'salvarAdicionais'])->name('itemCardapio.salvarAdicionais');

//
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/carrinho/store/{id}', [CarrinhoController::class, 'store'])->name('carrinho.store');



// Pedidos
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');


//Checkout
Route::get('/index-checkout', [CheckoutController::class, 'index'])->name('checkout.index');


Route::get('/sobre', function(){
    return '<h1>Sobre</h1>';
}
);
