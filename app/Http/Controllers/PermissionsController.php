<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
            'name' => 'required',
        ]);

        $permission = Permission::create(['name' => $request->name]);

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
            'name' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();


        return redirect('/admin/permissions')->with('success', 'Permiso actualizado exitosamente!');
    }



    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return response()->json(['success' => true]);

    }
}
