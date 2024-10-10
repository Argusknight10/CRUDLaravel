<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('register.index', [
            'title' => 'REGISTER PAGE',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $validateData['image']  = 'default.png';

        User::create($validateData);

        return redirect()->route('login.index')->with(['success' =>'Account has successfully added! Please Log in!']);
    }
}
