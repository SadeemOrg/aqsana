<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForm(Request $request, $token)
    {
        $email = DB::table('password_resets')->where('token', $request->token)->first()?->email;

        if (!$email) {
            return redirect('/');
        }

        return view('auth.passwords.reset', compact('token'));
    }

    public function update(Request $request)
    {
        $email = DB::table('password_resets')->where('token', $request->token)->first()?->email;
        $user = User::where('email', $email)->first();


        if ($request->password == $request->password_confirmation) {

            $user->password = Hash::make($request->password_confirmation);
            $user->save();
            DB::table('password_resets')->where('token', $request->token)->delete();
        }
        return redirect('/');
    }
}
