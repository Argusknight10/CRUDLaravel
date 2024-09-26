<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
            'title'         => 'unique|required|min:5',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:5000',
            'description'   => 'required|min:10',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/beritas', $image->hashName());

        $slug = Str::slug($request->title);

        Berita::create([
            'title'         => $request->title,
            'slug'          => $slug,
            'image'         => $image->hashName(),
            'description'   => $request->description,
        ]);
        
        return redirect()->route('beritas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
