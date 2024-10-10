<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index() :View {
        return view('login.index', [
            'title' => 'LOGIN PAGE'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse{
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if(Gate::allows('admin')){
                return redirect()->intended('/beritas')->with(['success' => 'Anda berhasil Log In sebagai ADMIN!']);
            } else {
                return redirect()->intended('/')->with(['success' => "Anda berhasil Log In!. "]);
            }
        } 

        return back()->with(['error' => "the provided credentials do not match our records. "])->onlyInput('error');
    }

    public function logout(Request $request ): RedirectResponse{
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
