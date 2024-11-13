<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdicionaisController;
use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\CidadesController;
use App\Http\Controllers\Admin\EnderecosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCardapioController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\SessaoController;

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

//Para reniciar a sessão atual
//Route::get('/reiniciar-sessao', [SessaoController::class, 'reiniciarSessao'])->name('sessao.reiniciar');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/admin/index-cidade',[CidadesController::class,'cidades'])->name('cidades.index');

//Usa-se esse prefixo pra agrupar as rotas que tem admin em comum
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    //Administrador
    Route::get('/dashboard', [AdminController::class, 'index'])->name('pedidos.index');
    Route::get('/dashboard/historico', [AdminController::class, 'historico'])->name('pedidos.historico');

    //Route::get('/pedidos', [PedidoController::class, 'index'])->name('admin.pedidos');
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('admin.pedidos.show');
    Route::post('/pedidos/avancar/{id}', [PedidoController::class, 'avancar'])->name('pedidos.avancar');
    Route::post('/pedidos/avancarPr/{id}', [PedidoController::class, 'avancarPr'])->name('pedidos.avancarPr');
    Route::post('/pedidos/finalizado/{id}', [PedidoController::class, 'finalizado'])->name('pedidos.finalizado');
    Route::post('/pedidos/{id}/cancelar', [PedidoController::class, 'cancelar'])->name('pedidos.cancelar');


    Route::get('/cidades',[CidadesController::class, 'cidades'] )->name('cidades.listar');

    Route::get('/cidades/salvar',[CidadesController::class, 'formAdicionar'] )->name('cidades.form');
    Route::post('/cidades/salvar',[CidadesController::class, 'adicionar'] )->name('cidades.adicionar');

    //Adicional
    Route::get('/index-adicionais', [AdicionaisController::class, 'index'])->name('adicionais.index');
    Route::get('/create-adicionais', [AdicionaisController::class, 'create'])->name('adicionais.create');
    Route::post('/store-adicionais', [AdicionaisController::class, 'store'])->name('adicionais.store');
    Route::get('/show-adicionais/{adicionais}', [AdicionaisController::class, 'show'])->name('adicionais.show');
    Route::get('/edit-adicionais/{adicionais}', [AdicionaisController::class, 'edit'])->name('adicionais.edit'); // método GET para exibir o formulário de edição
    Route::put('/update-adicionais/{adicionais}', [AdicionaisController::class, 'update'])->name('adicionais.update'); // método PUT para a atualização
    Route::delete('/destroy-adicionais/{adicionais}', [AdicionaisController::class, 'destroy'])->name('adicionais.destroy');

    //Categorias
    Route::get('/index-categorias',[CategoriasController::class,'index'])->name('categorias.index');
    Route::get('/create-categorias',[CategoriasController::class,'create'])->name('categorias.create');
    Route::post('/store-categorias',[CategoriasController::class,'store'])->name('categorias.store');
    Route::get('/show-categorias/{categorias}',[CategoriasController::class,'show'])->name('categorias.show');
    Route::get('/edit-categorias/{categorias}',[CategoriasController::class,'edit'])->name('categorias.edit');
    Route::put('/update-categorias/{categorias}',[CategoriasController::class,'update'])->name('categorias.update');
    Route::delete('/destroy-categorias/{categorias}',[CategoriasController::class,'destroy'])->name('categorias.destroy');




    //Enderecos
    Route::get('/index-enderecos',[EnderecosController::class, 'index'])->name('enderecos.index');


    //ItemCardapio
    Route::get('/index-itemCardapio',[ItemCardapioController::class,'index'])->name('itemCardapio.index');
    Route::get('/create-itemCardapio',[ItemCardapioController::class,'create'])->name('itemCardapio.create');
    Route::post('/store-itemCardapio',[ItemCardapioController::class,'store'])->name('itemCardapio.store');
    Route::get('/show-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'show'])->name('itemCardapio.show');
    Route::get('/edit-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'edit'])->name('itemCardapio.edit');
    Route::put('/show-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'update'])->name('itemCardapio.update');
    Route::delete('/destroy-itemCardapio/{itemCardapio}',[ItemCardapioController::class,'destroy'])->name('itemCardapio.destroy');

    Route::post('/show-cliente/{cliente}',[ClientesController::class,'show'])->name('clientes.show');
    Route::get('/index-cliente', [ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/edit-cliente', [ClientesController::class, 'index'])->name('clientes.edit');
    Route::delete('/destroy-cliente/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');


});

// Endereços
Route::get('/create-enderecos',[EnderecosController::class, 'create'])->name('enderecos.create');
Route::post('/store-enderecos',[EnderecosController::class, 'store'])->name('enderecos.store');
Route::get('/show-enderecos/{enderecos}',[EnderecosController::class,'show'])->name('enderecos.show');


    Route::get('itemCardapio/{itemCardapio}/product', [ItemCardapioController::class, 'product'])->name('itemCardapio.product');
     Route::post('itemCardapio/{itemCardapio}/salvar-adicionais', [ItemCardapioController::class, 'salvarAdicionais'])->name('itemCardapio.salvarAdicionais');
//Clientes
// Route::get('/index-cliente', [ClientesController::class, 'index'])->name('cliente.index');
Route::get('/create-cliente',[ClientesController::class,'create'])->name('cliente.create');
Route::post('/store-cliente',[ClientesController::class,'store'])->name('cliente.store');




//
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/carrinho/store/{id}', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::put('/carrinho/update', [CarrinhoController::class, 'update'])->name('carrinho.update');
Route::post('/carrinho/avancar', [CarrinhoController::class, 'avancar'])->name('carrinho.avancar');
Route::delete('/carrinho/remover{id}',[CarrinhoController::class, 'removeCarrinho'])->name('carrinho.remover');
Route::post('/carrinho/incrementar/{index}', [CarrinhoController::class, 'incrementar'])->name('carrinho.incrementar');
Route::post('/carrinho/decrementar/{index}', [CarrinhoController::class, 'decrementar'])->name('carrinho.decrementar');


// Pedidos
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
Route::get('/pedido/{id}', [CheckoutController::class, 'detalhesPedido'])->name('pedido.detalhes');
Route::get('/historico-pedidos', [PedidoController::class, 'historico'])->name('pedidos.historico');


//Checkout
Route::get('/index-checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/endereco/selecionar', [CheckoutController::class, 'selecionarEndereco'])->name('checkout.endereco.selecionar');
Route::post('/checkout/pagamento/selecionar', [CheckoutController::class, 'selecionarPagamento'])->name('checkout.pagamento.selecionar');
Route::post('checkout/finalizar', [CheckoutController::class, 'finalizarPedido'])->name('checkout.finalizar');

Route::get('/sobre', function(){
    return '<h1>Sobre</h1>';
}
);

// Auth::routes();

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
