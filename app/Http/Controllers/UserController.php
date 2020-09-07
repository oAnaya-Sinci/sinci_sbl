<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(Request $request)
    {
            $personas = User::join('groups','users.idgroup','=','groups.id')
            ->select('users.id','users.idgroup','groups.name as name_group','users.name','users.email','users.condicion','users.notificaciones')
            ->orderBy('users.id', 'desc')->get();

            $groups = Groups::where('condicion','=','1')
            ->where('id','>','1')
            ->select('id','name')->orderBy('name', 'asc')->get();
       
        return view('users.index')->with(compact('personas','groups'));
    }

    public function store(Request $request)
    {
            $role_user = Role::where('name', 'user')->first();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->idgroup = $request->idgroup;
            $user->condicion = '1';  
            $user->notificaciones = $request->notif ? true : false;     
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
            $user->idgroup = $request->idgroup;
            $user->condicion = '1';
            $user->notificaciones = $request->notif ? true : false; 
            $user->save();
            return Redirect::to('/user');

    }

    public function desactivar(Request $request)
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
}
