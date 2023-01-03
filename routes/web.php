<?php

use Illuminate\Support\Facades\Route;

Route::get('/',            "AuthController@login")->name('login');
Route::get ("/login", 		"AuthController@login")->name('login');
Route::post('/login', 		"AuthController@entrar");
Route::get ('/logout', 		'AuthController@logout')->name('logout');


Route::group(['middleware' => ['auth']], function () {

    Route::get ('/', 'HomeController@index')->name('home');
    Route::resource('solicitacao', 	 'SolicitacaoController');
    Route::resource('solicitacoes',  'SolicitacoesController');
    
    Route::get('solicitacao/send/{id}', 'SolicitacaoController@send')->name('send');
    Route::get('solicitacoes/solcreate/{id}', 'SolicitacoesController@solcreate')->name('solcreate');
    Route::resource('user', 'UserController');
    


    // Route::get('pegaunidadepec', 'SolicitacaoController@pegaUnidadePec');
    Route::get('/api/equipes', 'SolicitacaoController@getEquipes');
    Route::get('/api/acss', 'SolicitacaoController@getAcss');
    

    //Senha
    Route::get ('/alterasenha',					'UserController@AlteraSenha');
	Route::post('/salvasenha',   				'UserController@SalvarSenha');
	Route::post('/enviarsenhausuario',			'UserController@EnviarSenhaUsuario');
	Route::post('/zerarsenhausuario',   		'UserController@ZerarSenhaUsuario');
});