<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(Request $request)
    {
            $personas = User::all();
       
        return view('users.index')->with(compact('personas'));
    }

    public function store(Request $request)
    {
            $role_user = Role::where('name', 'user')->first();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';       
            $user->save();
            $user->roles()->attach($role_user);
            return Redirect::to('/user');

    }

    public function update(Request $request)
    {
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->save();
            return Redirect::to('/user');

    }

    public function desactivar()
    {
        
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
        return Redirect::to('/user');
    }

    public function activar(Request $request)
    {
        
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
        return Redirect::to('/user');
    }

    public function listMachinesUser(){
        $id = auth()->user()->id; 
        $users = User::join('machines','users.id','=','machines.iduser')
            ->select('machines.id','machines.name as name_machine')
            ->where('users.id','=', $id)->get();    
        return  $users;
    }
}
