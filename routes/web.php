<?php

use App\Http\Controllers\Admin\AdicionaisController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CidadesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class, 'index']); 

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
    Route::post('/show-adicionais/{adicionais}',[AdicionaisController::class, 'show'])->name('adicionais.show');
}
);

//Clientes 
Route::get('/index-cliente', [ClientesController::class, 'index'])->name('cliente.index');
Route::get('/create-cliente',[ClientesController::class,'create'])->name('cliente.create');
Route::post('/store-cliente',[ClientesController::class,'store'])->name('cliente.store');
Route::post('/show-cliente/{cliente}',[ClientesController::class,'show'])->name('cliente.show');

//Checkout
Route::get('/index-checkout', [CheckoutController::class, 'index'])->name('checkout.index');


Route::get('/sobre', function(){
    return '<h1>Sobre</h1>';
}
);
