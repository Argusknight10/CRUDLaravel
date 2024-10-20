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
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;

class BeritaController extends Controller
{
    public function index(Request $request): View{
        Gate::authorize('admin');
        $search = $request->input('search');
        if ($search) {
            $beritas = Berita::filter($request->only(['search']))->paginate(10);
        } else {
            $beritas = Berita::latest()->paginate(10);
        }

        return view('beritas.index', ['title' => 'BERITAS PAGE', 'beritas' => $beritas, 'search' => $search]);
    }

    public function create(): View
    {
        Gate::authorize('admin');
        return view('beritas.create', ['title' => 'ADD NEWS', 'kategori' => Kategori::all()]);
    }

    public function store(StoreBeritaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $image = $request->file('image');
        $path = $image->store('img', 'public');
        $filename = basename($path);

        // dd($image);
        $slug = Str::slug($validatedData['title']);

        Berita::create([
            'title'         => $validatedData['title'],
            'slug'          => $slug,
            'image'         => $filename,
            'kategori_id'   => $validatedData['kategori'],
            'deskripsi'     => $validatedData['deskripsi'],
        ]);

        return redirect()->route('beritas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $beritas = Berita::findOrFail($id);
        $beritaLain = Berita::paginate(10);

        return view('beritas.show', ['title' => 'DETAIL NEWS', 'beritas' => $beritas, 'beritaLain' => $beritaLain]);
    }

    public function edit(string $id): View
    {
        Gate::authorize('admin');
        $beritas = Berita::findOrFail($id);

        return view('beritas.edit', ['title' => 'EDIT NEWS', 'beritas' => $beritas, 'kategori' => Kategori::all()]);
    }

    public function update(UpdateBeritaRequest $request, $id): RedirectResponse
    {
        $beritas = Berita::findOrFail($id);

        $validatedData = $request->validated();

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

        $kategoriId = $request->kategori;
        if ($kategoriId === null) {
            $kategoriId = $beritas->kategori_id;
        }

        $slug = Str::slug($validatedData['title']);

        $beritas->update([
            'title'         => $validatedData['title'],
            'slug'          => $slug,
            'image'         => $filename,
            'kategori_id'   => $kategoriId,
            'deskripsi'     => $validatedData['deskripsi'],
        ]);

        return redirect()->route('beritas.index')->with(['success' => 'Perubahan Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse
    {
        Gate::authorize('admin');
        $beritas = Berita::findOrFail($id);

        if ($beritas->image) {
            Storage::disk('public')->delete('img/' . $beritas->image);
        }
        $beritas->delete();

        return redirect()->route('beritas.index')->with(['success' => 'Berita Berhasil Dihapus!']);
    }
}
