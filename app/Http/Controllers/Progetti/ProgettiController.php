<?php

namespace App\Http\Controllers\Progetti;

use App\Models\Commento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgettiController extends Controller
{
    public function counter()
    {
        return view('progetti.counter');
    }

    public function comment()
    {
        $commenti = Commento::where('user_id', auth()->user()->id)->get();

        return view('progetti.comment', compact('commenti'));
    }
}
