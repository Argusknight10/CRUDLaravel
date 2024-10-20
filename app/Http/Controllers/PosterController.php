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
use App\Http\Requests\StorePosterRequest;
use App\Http\Requests\UpdatePosterRequest;

class PosterController extends Controller
{
    public function index(Request $request): View
    {
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

    public function store(StorePosterRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $image = $validatedData->file('image');
        $path = $image->store('img', 'public');
        $filename = basename($path);

        // dd($image);
        $slug = Str::slug($validatedData['title']);

        Poster::create([
            'title'         => $validatedData['title'],
            'slug'          => $slug,
            'image'         => $filename,
            'deskripsi'     => $validatedData['deskripsi'],
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

    public function update(UpdatePosterRequest $request, $id): RedirectResponse
    {
        $posters = Poster::findOrFail($id);

        $validatedData = $request->validated();

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

        $slug = Str::slug($validatedData['title']);

        $posters->update([
            'title'         => $request['title'],
            'slug'          => $slug,
            'image'         => $filename,
            'deskripsi'     => $request['deskripsi'],
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
