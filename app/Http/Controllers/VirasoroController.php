<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VirasoroController extends Controller
{
    public function index()
    {
        return view('virasoro.index'); // Retorna una vista
    }

    public function pacientes()
    {
        $pacientes = DB::table('pacientes')
            ->select('id','apellido', 'nombre', 'dni', 'celular', 'nacimiento', 'obra_social', 
                DB::raw('TIMESTAMPDIFF(YEAR, nacimiento, CURDATE()) AS edad')
            )
            ->get();

        return view('virasoro.pacientes', compact('pacientes'));
    }

}
