<?php

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

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::get('/ProbandoConsulta', 'testDeletecontrol@show'); //abajo me da error por que no tengo usuario, solo quero ver usar eloquent

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/oee', 'OeeController');
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');


    Route::group(['middleware' => ['Usuario']], function () {
        

    });

    Route::group(['middleware' => ['Administrador']], function () {
        
        Route::get('/machine', 'MachineController@index');
        Route::post('/machine/registrar', 'MachineController@store');
        Route::put('/machine/actualizar', 'MachineController@update');
        Route::put('/machine/desactivar', 'MachineController@desactivar');
        Route::put('/machine/activar', 'MachineController@activar');
        Route::get('/machine/selectMachine', 'MachineController@selectMachine');

        Route::get('/variable', 'VariableController@index');
        Route::post('/variable/registrar', 'VariableController@store');
        Route::put('/variable/actualizar', 'VariableController@update');
        Route::put('/variable/desactivar', 'VariableController@desactivar');
        Route::put('/variable/activar', 'VariableController@activar');

        Route::get('/typeevent', 'TypeEventController@index');
        Route::post('/typeevent/registrar', 'TypeEventController@store');
        Route::put('/typeevent/actualizar', 'TypeEventController@update');
        Route::put('/typeevent/desactivar', 'TypeEventController@desactivar');
        Route::put('/typeevent/activar', 'TypeEventController@activar');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::get('/user/selectUser', 'UserController@selectUser');


     
    });

});

//Route::get('/home', 'HomeController@index')->name('home');
