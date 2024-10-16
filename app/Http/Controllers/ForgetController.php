<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgetController extends Controller
{
    public function index(){
        return view('forget.index', ['title' => 'FORGET PASSWORD PAGE']);
    }

    public function prosesEmail(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $email = $request->email;
        // dd($email);
        return redirect()->route('forget.reset',  ['email' => $email]);
    }

    public function resetPassword(Request $request){
        $email = $request->query('email');
        // dd($email);

        if (!$email) {
            return redirect()->route('forget.index')->with('error', 'Email tidak valid, silakan coba lagi.');
        }    
    
        return view('forget.reset', ['title' => 'RESET PASSWORD PAGE', 'email' => $email]);
    }

    public function verifPassword(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
            'email' => 'required|email|exists:users,email'
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forget.index')->with('error', 'Email tidak ditemukan.');
        }
    
        $user->update([
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('login')->with('success', 'Password Berhasil Diubah, Silahkan Login Dengan Password Baru!');
    }
    
}
