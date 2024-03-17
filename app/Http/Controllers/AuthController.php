<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function loginAction(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
          ]);


          if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
              $request->session()->regenerate();
              if ($request->password == '123456') return redirect('/change-password');
            return redirect()->intended('/');
          }

          return back()->with('error', 'Username / Password Salah');
    }

    public function storeReset(Request $request)
    {
      if ($request->password == '123456') {
        return back()->with('error', 'Gagal mengganti password');
      }

      try {
        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/');
      } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
      }
    }

    public function change_password()
    {
      return view('auth.change_password');
    }

    public function logout()
    {
      Auth::logout();
      return redirect('/login');
    }
}
