<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(): View
    {
        Gate::authorize('admin');
        
        $users = User::latest()->paginate(10);
        return view('users.index', ['title' => 'USER PAGE', 'users' => $users]);
    }

    public function show(string $id): View
    {
        $users = User::findOrFail($id);
        return view('users.show', ['title' => 'DETAIL USER', 'users' => $users]);
    }

    public function edit(string $id) : View {
        $users = User:: findOrFail($id);

        return view('users.edit', ['title' => 'EDIT NEWS', 'users' => $users, 'user' => User::all()]);
    }

    public function update(Request $request, $id): RedirectResponse{
        $users = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        if($request->hasFile('image')){
            Storage::delete('img', 'public'.$users->image);

            $image = $request->file('image');
            $path = $image->store('img', 'public');
            $filename = basename($path);
        } else {
            $filename = $users->image;
        }

        $users->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('users.index')->with(['success' => 'Perubahan Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse{
        Gate::authorize('admin');
        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('users.index')->with(['success' => 'User Berhasil Dihapus!']);
    }
}
