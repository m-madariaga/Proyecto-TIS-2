<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        $action = new Action();
            $action->name = 'Creación Permiso';
            $action->user_fk = Auth::User()->id;
        $action->save();

        return redirect('/admin/permissions')->with('success', 'Permiso creado exitosamente!');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);


        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required',Rule::unique('permissions')->ignore($id)],
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();

        $action = new Action();
            $action->name = 'Edición Permiso';
            $action->user_fk = Auth::User()->id;
        $action->save();


        return redirect('/admin/permissions')->with('success', 'Permiso actualizado exitosamente!');
    }



    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        $action = new Action();
            $action->name = 'Borrado Permiso';
            $action->user_fk = Auth::User()->id;
        $action->save();

        return response()->json(['success' => true]);

    }
}
