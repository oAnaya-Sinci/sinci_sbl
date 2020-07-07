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
        
        
        Route::get('/trends/{idvariable}', 'TrendsController@index')->name('trends');
        Route::get('/oee/{idmachine}', 'OeeController@index')->name('oee');
        Route::get('/events/{idmachine}', 'EventsController@index')->name('events');
        Route::get('/events/{idevent}/editm', 'EventsController@editm');
        Route::put('/events/{idmachine}', 'EventsController@update')->name('e_edit');
        Route::get('/trends/{idvariable}/{caso}/{date}/datos', 'TrendsController@datos');
        Route::get('/oee/{idmachine}/{caso}/{date}/{casoS}/datos', 'OeeController@datos');
        Route::get('/oee/{idmachine}/{caso}/{date}/{casoS}/{partid}/datos', 'OeeController@datospartid');
        Route::get('/oee/{idmachine}/{caso}/{date}/{casoS}/{partid}/{lotid}/datos', 'OeeController@datoslotid');
        Route::get('/oee/{idmachine}/{caso}/{date}/{casoS}/{partid}/{lotid}/{idshift}/datos', 'OeeController@datosidshift');
        Route::get('/Events/{idmachine}/{caso}/{date}/datos', 'EventsController@datos');
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

        Route::get('/groups', 'GroupController@index')->name('group');
        Route::post('/groups/registrar', 'GroupController@store')->name('g_registrar');
        Route::put('/groups/actualizar', 'GroupController@update')->name('g_edit');
        Route::put('/groups/desactivar', 'GroupController@desactivar')->name('g_desactivar');
        Route::put('/groups/activar', 'GroupController@activar')->name('g_activar');

        Route::get('/shift', 'ShiftController@index')->name('shift');
        Route::post('/shift/registrar', 'ShiftController@store')->name('s_registrar');
        Route::put('/shift/actualizar', 'ShiftController@update')->name('s_edit');
        Route::put('/shift/desactivar', 'ShiftController@desactivar')->name('s_desactivar');
        Route::put('/shift/activar', 'ShiftController@activar')->name('s_activar');

    });
});