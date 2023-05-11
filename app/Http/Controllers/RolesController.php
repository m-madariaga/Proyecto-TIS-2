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
                if($request->defaultCheck1==1){
                    $role->givePermissionTo('dashboard');
                }
                
                if($request->defaultCheck2==2){
                    $role->givePermissionTo('mantenedor usuarios');
                }
                
                if($request->defaultCheck3==3){
                    $role->givePermissionTo('mantenedor roles');
                }
                
                if($request->defaultCheck4==4){
                    $role->givePermissionTo('mantenedor permisos');
                }
                
                if($request->defaultCheck5==5){
                    $role->givePermissionTo('mantenedor productos');
                }

                if($request->defaultCheck6==6){
                    $role->givePermissionTo('mantenedor categorias');
                }

                if($request->defaultCheck7==7){
                    $role->givePermissionTo('mantenedor marcas');
                }

                if($request->defaultCheck8==8){
                    $role->givePermissionTo('mantenedor ventas');
                }

                if($request->defaultCheck9==9){
                    $role->givePermissionTo('mantenedor envio');
                }

                if($request->defaultCheck10==10){
                    $role->givePermissionTo('mantenedor tipo envio');
                }

                if($request->defaultCheck11==11){
                    $role->givePermissionTo('mantenedor metodo pago');
                }
                break;
            case 2:
                $role->givePermissionTo('vista analista');

                if($request->defaultCheck1==1){
                    $role->givePermissionTo('dashboard');
                }

                if($request->defaultCheck2==2){
                    $role->givePermissionTo('reporte ventas');
                }
                
                break;
            case 3:
                $role->givePermissionTo('vista cliente');
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
        $role->permissions = $role->getPermissionNames();
        error_log($role->permissions);

        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role_type' => 'nullable',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $permissions =collect();

        switch($request->role_type){
            case 1:
                
                $permissions->push('vista admin');
                if($request->defaultCheck1==1){
                    $permissions->push('dashboard');
                    error_log($permissions);
                }

                if($request->defaultCheck2==2){
                    $permissions->push('mantenedor usuarios');
                    error_log($permissions);
                }

                if($request->defaultCheck3==3){
                    $permissions->push('mantenedor roles');
                    error_log($permissions);
                }

                if($request->defaultCheck4==4){
                    $permissions->push('mantenedor permisos');
                    error_log($permissions);
                }
                
                if($request->defaultCheck5==5){
                    $permissions->push('mantenedor productos');
                    error_log($permissions);
                }

                if($request->defaultCheck6==6){
                    $permissions->push('mantenedor categorias');
                    error_log($permissions);
                }

                if($request->defaultCheck7==7){
                    $permissions->push('mantenedor marcas');
                    error_log($permissions);
                }

                if($request->defaultCheck8==8){
                    $permissions->push('mantenedor ventas');
                    error_log($permissions);
                }

                if($request->defaultCheck9==9){
                    $permissions->push('mantenedor envio');
                    error_log($permissions);
                }

                if($request->defaultCheck10==10){
                    $permissions->push('mantenedor tipo envio');
                    error_log($permissions);
                }

                if($request->defaultCheck11==11){
                    $permissions->push('mantenedor metodo pago');
                    error_log($permissions);
                }

                $role->syncPermissions([$permissions]);
                break;
            case 2:
                $permissions->push('vista analista');

                if($request->defaultCheck1==1){
                    $permissions->push('dashboard');
                    error_log($permissions);
                }

                if($request->defaultCheck2==2){
                    $permissions->push('reporte ventas');
                    error_log($permissions);
                }

                $role->syncPermissions([$permissions]);
                break;
            case 3:
                $role->syncPermissions(['vista cliente']);
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
        error_log("test");

        return response()->json(['success' => true]);

    }
}