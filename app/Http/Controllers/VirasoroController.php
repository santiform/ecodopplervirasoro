<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VirasoroController extends Controller
{
    public function index()
    {
        return view('virasoro.index'); // Retorna una vista
    }

}
