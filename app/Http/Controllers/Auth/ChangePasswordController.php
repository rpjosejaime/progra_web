<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('home')->with('success', 'Contraseña cambiada con éxito');
        } else {
            return back()->withErrors(['current_password' => 'La contraseña actual no es válida']);
        }
    }
}
