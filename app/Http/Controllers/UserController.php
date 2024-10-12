<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
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
            'username' => 'required|min:3|max:255|unique:users,username,' . $id,
            'email' => 'required|email:dns|unique:users,email,' . $id,
            'old_password' => 'nullable',
            'new_password' => 'nullable|min:5|max:255|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $users->password)) {
                return back()->with(['error' => 'Password lama salah.']);
            }
    
            $password = Hash::make($request->new_password);
        } else {
            $password = $users->password;
        }

        if($request->hasFile('image')){
            if ($users->image !== 'default.png') {
                Storage::disk('public')->delete('img/' . $users->image); 
            }

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
            'password' => $password,
            'image' => $filename
        ]);

        if (Gate::allows('admin')) {
            return redirect()->route('users.index')->with(['success' => 'Perubahan Berhasil Disimpan!']);
        } else {
            return redirect('/')->with(['success' => 'Perubahan Berhasil Disimpan!']);
        }
    }

    public function destroy($id): RedirectResponse{
        Gate::authorize('admin');
        $users = User::findOrFail($id);

        if ($users->image !== 'default.png') {
            Storage::disk('public')->delete('img/' . $users->image); 
        }
        $users->delete();

        return redirect()->route('users.index')->with(['success' => 'User Berhasil Dihapus!']);
    }
}
