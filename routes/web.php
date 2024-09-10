<?php

use App\Http\Controllers\Admin\CidadeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CidadesController;
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

    Route::resource('cidades', CidadeController::class)->except(['show']);
}
);

Route::get('/sobre', function(){
    return '<h1>Sobre</h1>';
}
);
