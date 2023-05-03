<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        foreach($roles as $role){
            if($role->hasPermissionTo('vista admin')){
                $role->role_type="Admin";
            }else if($role->hasPermissionTo('vista analista')){
                $role->role_type="Analista";
            }else{
                $role->role_type="Trabajador";
            }
            $user_amount = User::role($role->name)->get();
            $role->role_count= $user_amount->count();

        }

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role_type' => 'nullable',
        ]);

        $role = Role::create(['name' => $request->name]);

        switch($request->role_type){
            case 1:
                $role->givePermissionTo('vista admin');
                break;
            case 2:
                $role->givePermissionTo('vista analista');
                break;
            case 3:
                $role->givePermissionTo('vista trabajador');
                break;
            default:
        }

        return redirect('/admin/roles')->with('success', 'Rol creado exitosamente!');
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if($role->hasPermissionTo('vista admin')){
            $role->role_type=1;
        }else if($role->hasPermissionTo('vista analista')){
            $role->role_type=2;
        }else{
            $role->role_type=3;
        }

        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        error_log("test");
        $request->validate([
            'name' => 'required',
            'role_type' => 'nullable',
        ]);

        error_log("test");

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        switch($request->role_type){
            case 1:
                $role->syncPermissions(['vista admin']);
                break;
            case 2:
                $role->syncPermissions(['vista analista']);
                break;
            case 3:
                $role->syncPermissions(['vista trabajador']);
                break;
            default:
        }
        error_log("test");

        return redirect('/admin/roles')->with('success', 'Rol actualizado exitosamente!');
    }


    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json(['success' => true]);

    }
}