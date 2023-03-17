<?php

namespace App\Http\Controllers\Progetti;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgettiController extends Controller
{
    public function counter()
    {
        return view('progetti.counter');
    }

    public function comment()
    {
        return view('progetti.comment');
    }
}
