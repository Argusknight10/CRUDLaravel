<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index() : View{
        $beritas = Berita::latest()->paginate(10);
        return view('beritas.index', compact('beritas'));
    }

    public function create() : View{
        return view('beritas.create');
    }

    public function store(Request $request): RedirectResponse{
        $request->validate([
            'title'         => 'required|unique:beritas',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:500000000',
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
            'deskripsi'   => $request->deskripsi,
        ]);
        
        return redirect()->route('beritas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id) : View {
        $beritas = Berita::findOrFail($id);

        return view('beritas.show', compact('beritas'));
    }

    public function edit(string $id) : View {
        $beritas = Berita:: findOrFail($id);

        return view('beritas.edit', compact('beritas'));
    }

    public function update(Request $request, $id): RedirectResponse{
        $beritas = Berita::findOrFail($id);

        $request->validate([
            'title'         => [
                'required',
                Rule::unique('beritas')->ignore($beritas->id)
            ],
            'image'         => 'nullable|image|mimes:jpeg,jpg,png|max:500000000',
            'deskripsi'   => 'required|min:10',
        ]);

        if($request->hasFile('image')){
            Storage::delete('img', 'public'.$beritas->image);

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
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('beritas.index')->with(['success' => 'Perubahan Berhasil Disimpan!']);
    }
}
