<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\User;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::all();
        foreach($actions as $action){
            $user= User::find($action->user_fk);
            $action->username= $user->name;
        }
        return view('actions.index', compact('actions'));
    }

    public function destroy($id)
    {
        $action = Action::find($id);
        $action->delete();
        error_log("test");

        return response()->json(['success' => true]);

    }
}
