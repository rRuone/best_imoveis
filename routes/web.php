<?php


use App\Http\Controllers\Admin\CidadeController;
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
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.pedidos.index');

    //Route::get('/pedidos', [PedidoController::class, 'index'])->name('admin.pedidos');
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('admin.pedidos.show');
    Route::post('/pedidos/avancar/{id}', [PedidoController::class, 'avancar'])->name('pedidos.avancar');
    Route::post('/pedidos/avancarPr/{id}', [PedidoController::class, 'avancarPr'])->name('pedidos.avancarPr');
    Route::post('/pedidos/finalizado/{id}', [PedidoController::class, 'finalizado'])->name('pedidos.finalizado');


    Route::get('/cidades',[CidadesController::class, 'cidades'] )->name('cidades.listar');

    Route::get('/cidades/salvar',[CidadesController::class, 'formAdicionar'] )->name('cidades.form');
    Route::post('/cidades/salvar',[CidadesController::class, 'adicionar'] )->name('cidades.adicionar');
}
);

Route::get('/sobre', function(){
    return '<h1>Sobre</h1>';
}
);
