<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Poster;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $berita1 = Berita::first();
        $berita_kami = Berita::take(6)->get();
    
        $search = $request->input('search');
        if ($search) {
            $berita = Berita::filter(['search' => $search])->get();
            $poster = Poster::filter(['search' => $search])->get();

            if ($berita->count() > 0) {
                return redirect()->to('/berita?search=' . urlencode($search));
            } elseif ($poster->count() > 0) {
                return redirect()->to('/poster?search=' . urlencode($search));
            } else {
                return redirect('/')->with(['error' => 'Konten yang anda cari tidak ditemukan!']);
            }
        }

        $poster = Poster::latest()->take(4)->get();
        $berita_baru = Berita::latest()->take(3)->get();
    
        return view('home', [
            'title' => 'HOME PAGE',
            'berita1' => $berita1,
            'berita_kami' => $berita_kami,
            'berita_baru' => $berita_baru,
            'search' => $search,
            'poster' => $poster
        ]);
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

    public function poster(Request $request){
        $search = $request->input('search');

        if ($search) {
            $konten_poster = Poster::filter($request->only(['search']))->paginate(10);
        } else {
            $konten_poster = Poster::paginate(10);
        }

        return view('poster', ['title' => 'POSTER PAGE', 'konten_poster' => $konten_poster, 'search' => $search]);
    }
}
