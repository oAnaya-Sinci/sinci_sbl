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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware'=>['auth']],function(){

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['User']], function () {
        
        
        Route::get('/user/listVaribles', 'UserController@listVaribles');

    });

    Route::group(['middleware' => ['Admin']], function () {
        
        
        Route::get('/machine', 'MachineController@index')->name('machine');
        Route::post('/machine/registrar', 'MachineController@store')->name('m_registrar');
        Route::put('/machine/actualizar', 'MachineController@update')->name('m_edit');
        Route::put('/machine/desactivar', 'MachineController@desactivar')->name('m_desactivar');
        Route::put('/machine/activar', 'MachineController@activar')->name('m_activar');

        Route::get('/variable', 'VariableController@index')->name('variable');
        Route::post('/variable/registrar', 'VariableController@store')->name('v_registrar');
        Route::put('/variable/actualizar', 'VariableController@update')->name('v_edit');
        Route::put('/variable/desactivar/', 'VariableController@desactivar')->name('v_desactivar');
        Route::put('/variable/activar', 'VariableController@activar')->name('v_activar');
    

        Route::get('/typeevent', 'TypeEventController@index')->name('typeevent');
        Route::post('/typeevent/registrar', 'TypeEventController@store')->name('t_registrar');
        Route::put('/typeevent/actualizar', 'TypeEventController@update')->name('t_edit');
        Route::put('/typeevent/desactivar', 'TypeEventController@desactivar')->name('t_desactivar');
        Route::put('/typeevent/activar', 'TypeEventController@activar')->name('t_activar');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/user', 'UserController@index')->name('user');
        Route::post('/user/registrar', 'UserController@store')->name('u_registrar');
        Route::put('/user/actualizar', 'UserController@update')->name('u_edit');
        Route::put('/user/desactivar', 'UserController@desactivar')->name('u_desactivar');
        Route::put('/user/activar', 'UserController@activar')->name('u_activar');
        Route::get('/user/listVaribles', 'UserController@listVaribles');

    });
});