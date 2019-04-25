<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


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
    // return view('welcome');
    return view('login.index');
});

Route::get('/esqueci', function () {
    // return view('welcome');
    return view('login.esqueci');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mensagens', 'HomeController@mensagens');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/administrador', 'AdministradorController@index');
Route::get('/administrador/usuarios', 'AdministradorController@usuarios');
Route::get('/administrador/excluidos', 'AdministradorController@usuariosExluidos');
Route::get('/administrador/empresas-excluidas', 'AdministradorController@empresasExcluidas');
Route::post('/administrador/usuariosjson', 'AdministradorController@ajaxUsuarios');
Route::post('/deleta-usuario', 'AdministradorController@deletaUsuario');
Route::post('/inativa-usuario', 'AdministradorController@inativaUsuario');
Route::post('/reativa-usuario', 'AdministradorController@reativaUsuario');
Route::post('/pega-supervisores', 'AdministradorController@retSupervisores');
Route::post('/pega-supervisores-todos', 'AdministradorController@retSupervisoresAll');
Route::post('/pega-empresas', 'AdministradorController@retEmpresas');
Route::post('/cria-usuario', 'AdministradorController@criaUsuario');
Route::post('/edita-usuario', 'AdministradorController@editaUsuario');
Route::post('/reativa-usuario-deletado', 'AdministradorController@reativaUsuarioDeletado');
Route::get('/analista', 'AnalistaController@index');
Route::get('/cliente/cria-novo', 'ClienteController@criaNovo');
Route::get('/administrador/empresas', 'AdministradorController@empresas');
Route::post('/administrador/empresasjson', 'EmpresaController@ajaxEmpresas');
Route::post('/reativa-empresa', 'EmpresaController@reativaEmpresa');
Route::post('/inativa-empresa', 'EmpresaController@inativaEmpresa');
Route::post('/cria-empresa', 'EmpresaController@criaEmpresa');
Route::post('/edita-empresa', 'EmpresaController@editaEmpresa');
Route::post('/reativa-empresa-deletada', 'EmpresaController@reativaEmpresaDeletada');
Route::post('/deleta-empresa', 'EmpresaController@deletaEmpresa');

Route::get('/administrador/clientes', 'AdministradorController@clientes');
Route::post('/cria-cliente', 'ClienteController@criar');
Route::post('/altera-cliente', 'ClienteController@modificar');

Route::post('/pega-cidades', 'CidadeController@pegatodas');

Route::post('/administrador/clientesjson', 'ClienteController@ajaxClientes');

Route::get('/teste', 'ClienteController@teste');