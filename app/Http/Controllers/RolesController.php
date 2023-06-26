<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\statusChangeEmail;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

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
                $role->role_type="Cliente";
            }
            $role->permissions = $role->getPermissionNames();
            $user_amount = User::role($role->name)->get();
            $role->role_count= $user_amount->count();

        }

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::whereNotIn('name', ['vista cliente', 'vista admin', 'vista analista'])->pluck('name');
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'role_type' => 'nullable',
        ]);
 
        $permissions = Permission::whereNotIn('name', ['vista cliente', 'vista admin', 'vista analista'])->pluck('name');

        $role = Role::create(['name' => $request->name]);

        switch($request->role_type){
            case 1:
                $role->givePermissionTo('vista admin');             
                break;
            case 2:
                $role->givePermissionTo('vista analista');        
                break;
            case 3:
                $role->givePermissionTo('vista cliente');
                break;
            default:
        }

        foreach($request->all() as $permission){
            if(in_array($permission, $permissions->all())){
                $role->givePermissionTo($permission);
                error_log($permission);
                error_log("true");
            }else{
                error_log($permission);
                error_log("false");
            }
        }

        $action = new Action();
            $action->name = 'Creación Rol';
            $action->user_fk = Auth::User()->id;
        $action->save();

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
        $role->permissions = $role->getPermissionNames();
        error_log($role->permissions);
        $permissions = Permission::whereNotIn('name', ['vista cliente', 'vista admin', 'vista analista'])->pluck('name');

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required',Rule::unique('roles')->ignore($id)],
            'role_type' => 'nullable',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $permissions = Permission::whereNotIn('name', ['vista cliente', 'vista admin', 'vista analista'])->pluck('name');
        $newPermissions =collect();

        switch($request->role_type){
            case 1:
                
                $newPermissions->push('vista admin');          
                break;
            case 2:
                $newPermissions->push('vista analista');
                break;
            case 3:
                $role->syncPermissions(['vista cliente']);
                break;
            default:
        }

        foreach($request->all() as $permission){
            if(in_array($permission, $permissions->all())){
                $newPermissions->push($permission);
                error_log($permission);
                error_log("true");
            }else{
                error_log($permission);
                error_log("false");
            }
        }

        $role->syncPermissions([$newPermissions]);
        error_log("test");

        $action = new Action();
            $action->name = 'Edición Rol';
            $action->user_fk = Auth::User()->id;
        $action->save();

        // Mail::to('admin@test.cl')->queue(new statusChangeEmail($role->name, $request->role_type, $role->id));

        return redirect('/admin/roles')->with('success', 'Rol actualizado exitosamente!');
    }


    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        error_log("test");

        $action = new Action();
            $action->name = 'Borrado Rol';
            $action->user_fk = Auth::User()->id;
        $action->save();

        return response()->json(['success' => true]);

    }
}