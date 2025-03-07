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

    public function pacientesNuevo()
    {
        return view('virasoro.pacientesNuevo');
    }

    public function pacientesNuevoGuardar(Request $request) {
        // Validar datos
        $request->validate([
            'dni' => 'required|max:15',
            'apellido' => 'required|string|max:50',
            'nombre' => 'required|string|max:50',
            'nacimiento' => 'required|date',
            'celular' => 'required|string|max:20',
            'obra_social' => 'required|string|max:20',
        ]);

        // Insertar datos en la tabla 'pacientes'
        DB::table('pacientes')->insert([            
            'apellido' => $request->apellido,
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'nacimiento' => $request->nacimiento,
            'celular' => $request->celular,
            'obra_social' => $request->obra_social,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Paciente agregado correctamente ✔');
    }    

    public function pacienteLegajo($id) {

        $paciente = DB::table('pacientes')->where('id', $id)->first();

        return view('virasoro.pacienteLegajo', compact('paciente'));
    }    

}
