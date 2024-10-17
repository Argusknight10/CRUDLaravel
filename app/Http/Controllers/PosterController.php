<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PosterController extends Controller
{
    public function index(): View
    {
        Gate::authorize('admin');

        $posters = Poster::latest()->paginate(10);
        // return view('posters.index', compact('posters')); // Sama Saja

        return view('posters.index', ['title' => 'POSTERS PAGE', 'posters' => $posters]);
    }
}
