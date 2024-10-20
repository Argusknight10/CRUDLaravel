<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    public function index(Request $request): View{
        Gate::authorize('admin');
        $search = $request->input('search');
        if ($search) {
            $kategoris = Kategori::filter($request->only(['search']))->paginate(10);
        } else {
            $kategoris = Kategori::latest()->paginate(10);
        }

        return view('kategoris.index', ['title' => 'KATEGORIS PAGE', 'kategoris' => $kategoris, 'search' => $search]);
    }

    public function create() : View{
        Gate::authorize('admin');
        return view('kategoris.create', ['title' => 'ADD CATEGORY', 'kategori' => Kategori::all()]);
    }

    public function store(StoreKategoriRequest $request): RedirectResponse{

        $validatedData = $request->validated();

        $slug = Str::slug($validatedData['name']);

        Kategori::create([
            'name'         => $validatedData['name'],
            'slug'          => $slug,
        ]);
        
        return redirect()->route('kategoris.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id) : View {
        Gate::authorize('admin');
        $kategoris = Kategori:: findOrFail($id);

        return view('kategoris.edit', ['title' => 'EDIT CATEGORY', 'kategoris' => $kategoris]);
    }

    public function update(UpdateKategoriRequest $request, $id): RedirectResponse{

        $kategoris = Kategori::findOrFail($id);

        $validatedData = $request->validated();

        $slug = Str::slug($validatedData['name']);

        $kategoris->update([
            'name'         => $validatedData['name'],
            'slug'          => $slug,
        ]);

        return redirect()->route('kategoris.index')->with(['success' => 'Perubahan Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse{
        Gate::authorize('admin');

        $kategoris = Kategori::findOrFail($id);
        $kategoris->beritas()->update(['kategori_id' => null]);
        $kategoris->delete();

        return redirect()->route('kategoris.index')->with(['success' => 'Kategori Berhasil Dihapus!']);
    }
}
