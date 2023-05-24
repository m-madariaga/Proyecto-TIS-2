<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePasswordLanding(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('profile_landing')->with('success', 'Contraseña actualizada exitosamente.');
        } else {
            return back()->withErrors(['current_password' => 'La contraseña actual no es válida.']);
        }
    }

    // public function changePasswordArgon(Request $request)
    // {
    //     $user = User::find(Auth::id());
    //     $request->validate([
    //         'current_password' => 'required',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     if (Hash::check($request->current_password, $user->password)) {
    //         $user->password = Hash::make($request->password);
    //         $user->save();

    //         return redirect()->route('profile')->with('success', 'Contraseña actualizada exitosamente.');
    //     } else {
    //         return back()->withErrors(['current_password' => 'La contraseña actual no es válida.']);
    //     }
    // }
}
