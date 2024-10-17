<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $berita1 = Berita::first();

        $search = $request->input('search');

        if ($search) {
            return redirect('/berita')->with([
                'search' => $search,
            ]);
        } else {
            $berita2 = Berita::paginate(4);
        }

        $berita3 = Berita::paginate(2);

        return view('home', ['title' => 'HOME PAGE', 'berita1' => $berita1, 'berita2' => session('berita2', $berita2), 'berita3' => $berita3, 'search' => $search]);
    }

    public function show(string $id) : View {
        $berita = Berita::findOrFail($id);

        return view('berita.show', ['title' => 'DETAIL NEWS', 'berita' => $berita]);
    }

    public function berita(Request $request){
        $search = $request->input('search');

        if ($search) {
            $konten_berita = Berita::filter($request->only(['search']))->paginate(10);
        } else {
            $konten_berita = Berita::paginate(10);
        }

        return view('berita', ['title' => 'BERITA PAGE', 'konten_berita' => $konten_berita, 'search' => $search]);
    }
}
