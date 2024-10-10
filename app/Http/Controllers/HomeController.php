<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $berita1 = Berita::first();
        $berita2 = Berita::all();
        $berita3 = Berita::paginate(2);
      
        return view('home', ['title' => 'HOME PAGE', 'berita1' => $berita1, 'berita2' => $berita2, 'berita3' => $berita3]);
    }

    public function show(string $id) : View {
        $berita = Berita::findOrFail($id);

        return view('berita.show', ['title' => 'DETAIL NEWS', 'berita' => $berita]);
    }
}
