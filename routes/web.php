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

});