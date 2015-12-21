<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/ticket/{id}', "PesquisaController@index");
Route::post('/pesquisa/cadastrar/{id}', "PesquisaController@store");


Route::group(['prefix'=>'painel'], function(){
        Route::get('/', "PainelController@index");
        Route::get('perguntas', [
                'uses' => "PerguntaController@perguntasGet",
                'as' => 'perguntas.main'
        ]);
        //rota usada pelo angular para carregar os dados em json.
        Route::get('perguntas/json/', "PerguntaController@perguntasJson");
        Route::get('respostas', "ResultadosController@index");
        Route::get('exportar', "PainelController@exportarPost");
        Route::get('dias', [
                'uses' =>"PainelController@definirDiasGet",
                'as' => 'dias.get'
        ]);

        Route::post('dias', "PainelController@definirDiasPost");
        //rota usada pelo angular para gravar os dados da pergunta.
        Route::post('pergunta', "PerguntaController@store");

        //rotas para pergunta
        Route::group(['prefix' => 'pergunta/{id}'], function(){
                Route::get('editar', "PerguntaController@edit");
                //rota usada para edição de dados.
                Route::put('editar', [
                        'as' => 'pergunta.editar',
                        'uses' => 'PerguntaController@editar'
                ]);
                Route::put('editar/status', "PerguntaController@editarStatus");
                Route::get('remover', "PerguntaController@destroy");
        });
       //Route::get('/resultado/{id}', "ResultadoController@show");


});