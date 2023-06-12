<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
 
    return redirect('login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/graficos', 'HomeController@graficos')->name('graficos');

Route::get('/produtos/pesquisa', 'ProdutosController@Buscar');
Route::post('/produtos/pesquisa', 'ProdutosController@Buscar')->name('Buscar');
Route::get('/caixa/pesquisa', 'CaixaController@buscarcaixa');
Route::post('/caixa/pesquisa', 'CaixaController@buscarcaixa')->name('buscarcaixa');
Route::get('/caixa/filtrocat', 'CaixaController@filtroCategorias');
Route::post('/caixa/filtrocat', 'CaixaController@filtroCategorias')->name('filtroCategorias');
Route::get('/caixa/filtroope', 'CaixaController@filtroOperacao');
Route::post('/caixa/filtroope', 'CaixaController@filtroOperacao')->name('filtroOperacao');
Route::get('/estoque/pesquisa', 'ProdutosController@buscarestoque');
Route::post('/estoque/pesquisa', 'ProdutosController@buscarestoque')->name('buscarestoque');

Route::resource('/produtos/carrinhos', 'CarrinhosController');
Route::resource('/produtos', 'ProdutosController'); //rota da função buscar da página de produtos
Route::resource('/caixa', 'CaixaController'); //rota da função buscar da página caixa
Route::resource('/categoria', 'CategoriasController');
Route::resource('/estoque', 'ProdutosController'); //rota da função buscar da página estoque
Route::resource('/graficos', 'CaixaController'); //rota da função buscar da página graficos

Route::get('/autocomplete', 'ProdutosController@autocomplete')->name('autocomplete');

Route::get('/caixa-comidas', 'CaixaController@filtrocomidas');
Route::post('/caixa-comidas','CaixaController@filtrocomidas')->name('filtrocomidas');

Route::get('/caixa-bebidas', 'CaixaController@filtrobebidas');
Route::post('/caixa-bebidas','CaixaController@filtrobebidas')->name('filtrobebidas');

Route::get('/estoque-quantidade','ProdutosController@filtroestoquequantidade');
Route::post('/estoque-quantidade','ProdutosController@filtroestoquequantidade')->name('filtroestoquequantidade');

Route::get('/estoque-preco','ProdutosController@filtroestoquepreco');
Route::post('/estoque-preco','ProdutosController@filtroestoquepreco')->name('filtroestoquepreco');

Route::get('/repor','ProdutosController@repor');
Route::post('/repor','ProdutosController@repor')->name('repor');

Route::get('/retirada','ProdutosController@retirar');
Route::post('/retirada','ProdutosController@retirar')->name('retirar');

Route::get('/estoque-ordem','ProdutosController@filtroestoqueordem');
Route::post('/estoque-ordem','ProdutosController@filtroestoqueordem')->name('filtroestoqueordem');

Route::get('/estoque-validade','ProdutosController@filtroestoquedataval');
Route::post('/estoque-validade','ProdutosController@filtroestoquedataval')->name('filtroestoquedataval');

Route::get('/produtos-comprar','CarrinhosController@comprar');
Route::post('/produtos-comprar','CarrinhosController@comprar')->name('comprar');

Route::get('/graf-pesquisa','CaixaController@buscargraficos');
Route::post('/graf-pesquisa','CaixaController@buscargraficos')->name('buscargraficos');

Route::get('/graficos-maisvendidos','CaixaController@maisvendidosgrafico');
Route::post('/graficos-maisvendidos','CaixaController@maisvendidosgrafico')->name('maisvendidosgrafico');

