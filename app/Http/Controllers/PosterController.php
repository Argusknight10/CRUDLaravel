<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    public function index(Request $request): View{
        Gate::authorize('admin');
        $search = $request->input('search');
        if ($search) {
            $posters = Poster::filter($request->only(['search']))->paginate(10);
        } else {
            $posters = Poster::latest()->paginate(10);
        }

        return view('posters.index', ['title' => 'POSTERS PAGE', 'posters' => $posters, 'search' => $search]);
    }

    public function create(): View
    {
        Gate::authorize('admin');
        return view('posters.create', ['title' => 'ADD POSTERS']);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'         => 'required|unique:posters',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:500000000',
            'deskripsi'   => 'nullable|min:10',
        ]);

        $image = $request->file('image');
        $path = $image->store('img', 'public');
        $filename = basename($path);

        // dd($image);
        $slug = Str::slug($request->title);

        Poster::create([
            'title'         => $request->title,
            'slug'          => $slug,
            'image'         => $filename,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('posters.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $posters = Poster::findOrFail($id);
        // $beritaLain = Berita::paginate(10);

        return view('posters.show', [
            'title' => 'DETAIL NEWS', 
            'posters' => $posters, 
            // 'beritaLain' => $beritaLain
        ]);
    }

    public function edit(string $id): View
    {
        Gate::authorize('admin');
        $posters = Poster::findOrFail($id);

        return view('posters.edit', ['title' => 'EDIT NEWS', 'posters' => $posters]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $posters = Poster::findOrFail($id);

        $request->validate([
            'title'         => [
                'required',
                Rule::unique('posters')->ignore($posters->id)
            ],
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:500000000',
            'deskripsi'   => 'nullable|min:10',
        ]);

        if ($request->hasFile('image')) {
            if ($posters->image) {
                Storage::disk('public')->delete('img/' . $posters->image);
            }

            $image = $request->file('image');
            $path = $image->store('img', 'public');
            $filename = basename($path);
        } else {
            $filename = $posters->image;
        }

        $slug = Str::slug($request->title);

        $posters->update([
            'title'         => $request->title,
            'slug'          => $slug,
            'image'         => $filename,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('posters.index')->with(['success' => 'Perubahan Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse
    {
        Gate::authorize('admin');
        $posters = Poster::findOrFail($id);

        if ($posters->image) {
            Storage::disk('public')->delete('img/' . $posters->image);
        }
        $posters->delete();

        return redirect()->route('posters.index')->with(['success' => 'Berita Berhasil Dihapus!']);
    }
}
