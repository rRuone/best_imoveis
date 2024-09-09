<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CidadesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientesController;

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
// index
Route::redirect('/','/admin/cidades');


//Usa-se esse prefixo pra agrupar as rotas que tem admin em comum
Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/cidades',[CidadesController::class, 'cidades'] )->name('cidades.listar');

    Route::get('/cidades/salvar',[CidadesController::class, 'formAdicionar'] )->name('cidades.form');
    Route::post('/cidades/salvar',[CidadesController::class, 'adicionar'] )->name('cidades.adicionar');
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
