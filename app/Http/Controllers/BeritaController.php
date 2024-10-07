<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index() : View{
        Gate::authorize('admin');

        $beritas = Berita::latest()->paginate(10);
        // return view('beritas.index', compact('beritas')); // Sama Saja

        return view('beritas.index', ['title' => 'NEWS PAGE', 'beritas' => $beritas]) ;
    }

    public function create() : View{
        Gate::authorize('admin');
        return view('beritas.create', ['title' => 'ADD NEWS', 'kategori' => Kategori::all()]);
    }

    public function store(Request $request): RedirectResponse{
        $request->validate([
            'title'         => 'required|unique:beritas',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:500000000',
            'kategori'      => 'required',
            'deskripsi'   => 'required|min:10',
        ]);

        $image = $request->file('image');
        $path = $image->store('img', 'public');
        $filename = basename($path);

        // dd($image);
        $slug = Str::slug($request->title);

        Berita::create([
            'title'         => $request->title,
            'slug'          => $slug,
            'image'         => $filename,
            'kategori_id'      => $request->kategori,
            'deskripsi'   => $request->deskripsi,
        ]);
        
        return redirect()->route('beritas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id) : View {
        $beritas = Berita::findOrFail($id);

        return view('beritas.show', ['title' => 'DETAIL NEWS', 'beritas' => $beritas]);
    }

    public function edit(string $id) : View {
        Gate::authorize('admin');
        $beritas = Berita:: findOrFail($id);

        return view('beritas.edit', ['title' => 'EDIT NEWS', 'beritas' => $beritas, 'kategori' => Kategori::all()]);
    }

    public function update(Request $request, $id): RedirectResponse{
        $beritas = Berita::findOrFail($id);

        $request->validate([
            'title'         => [
                'required',
                Rule::unique('beritas')->ignore($beritas->id)
            ],
            'image'         => 'nullable|image|mimes:jpeg,jpg,png|max:500000000',
            'kategori'         => 'nullable',
            'deskripsi'   => 'required|min:10',
        ]);

        if ($request->hasFile('image')) {
            if ($beritas->image) { 
                Storage::disk('public')->delete('img/' . $beritas->image); 
            }

            $image = $request->file('image');
            $path = $image->store('img', 'public');
            $filename = basename($path);
        } else {
            $filename = $beritas->image;
        }

        $slug = Str::slug($request->title);

        $beritas->update([
            'title'         => $request->title,
            'slug'          => $slug,
            'image'         => $filename,
            'kategori_id'      => $request->kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('beritas.index')->with(['success' => 'Perubahan Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse{
        Gate::authorize('admin');
        $beritas = Berita::findOrFail($id);

        Storage::delete('img'.$beritas->image);
        $beritas->delete();

        return redirect()->route('beritas.index')->with(['success' => 'Berita Berhasil Dihapus!']);
    }
}
