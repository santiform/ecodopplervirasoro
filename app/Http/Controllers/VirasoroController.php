<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


use PDF;


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

        $estudios = DB::table('estudios')
            ->join('tipos_estudios', 'estudios.id_tipo_estudio', '=', 'tipos_estudios.id')
            ->where('estudios.id_paciente', $id)
            ->select('estudios.*', 'tipos_estudios.nombre as estudio_nombre')
            ->get();

        // Convertir la fecha a formato 'd/m/Y'
        foreach ($estudios as $estudio) {
            // Asumiendo que el campo 'fecha' es un campo de tipo fecha en la base de datos
            $estudio->fecha = Carbon::parse($estudio->fecha)->format('d/m/Y');
        }

        return view('virasoro.pacienteLegajo', compact('paciente', 'estudios'));
    }

    public function pacienteEditar($id) {

        $paciente = DB::table('pacientes')->where('id', $id)->first();

        return view('virasoro.pacienteEditar', compact('paciente'));
    }

    public function pacienteEditarGuardar(Request $request, $id) {
        // Validar datos
        $request->validate([
            'dni' => 'required|max:15',
            'apellido' => 'required|string|max:50',
            'nombre' => 'required|string|max:50',
            'nacimiento' => 'required|date',
            'celular' => 'required|string|max:20',
            'obra_social' => 'required|string|max:20',
        ]);

        // Actualizar datos en la tabla 'pacientes'
        $actualizado = DB::table('pacientes')
            ->where('id', $id) // Buscar por ID
            ->update([
                'apellido' => $request->apellido,
                'nombre' => $request->nombre,
                'dni' => $request->dni,
                'nacimiento' => $request->nacimiento,
                'celular' => $request->celular,
                'obra_social' => $request->obra_social,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('edited', 'Paciente editado correctamente ✔');
 
    }

    public function pacienteEliminar($id) {
        // Buscar el paciente antes de eliminar
        $paciente = DB::table('pacientes')->where('id', $id)->first();

        // Eliminar el paciente
        DB::table('pacientes')->where('id', $id)->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('pacientes')->with('deleted', 'Paciente eliminado correctamente ✔');
    }

    public function pacienteNuevoEstudio($id) {

        $paciente = DB::table('pacientes')->where('id', $id)->first();

        $tipos_estudios =  DB::table('tipos_estudios')->get();

        return view('virasoro.pacienteNuevoEstudio', compact('paciente', 'tipos_estudios'));
    }

    public function pacienteNuevoEstudio2($id, $estudio_id) {

        $paciente = DB::table('pacientes')->where('id', $id)->first();

        $tipo_estudio =  DB::table('tipos_estudios')->where('id', $estudio_id)->first();

        return view('virasoro.pacienteNuevoEstudio2', compact('paciente', 'tipo_estudio'));
    }

    public function pacienteNuevoEstudio3(Request $request) {
        // Validar los datos recibidos


        // Guardar el nuevo estudio en la base de datos
        $estudio = DB::table('estudios')->insertGetId([
            'id_paciente' => $request->input('paciente_id'),
            'id_tipo_estudio' => $request->input('estudio_id'),
            'fecha' => $request->input('fecha'),
            'solicitante' => $request->input('solicitante'),
            'informe' => $request->input('informe'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Verificar si se han subido archivos
        if ($request->hasFile('archivos')) {
            $archivos = $request->file('archivos');
            $folderPath = public_path('uploads/estudios/' . $estudio); // Crear carpeta con el ID del estudio

            // Crear la carpeta si no existe
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            // Guardar cada archivo con el nombre adecuado
            foreach ($archivos as $index => $archivo) {
                $extension = $archivo->getClientOriginalExtension(); // Obtener la extensión del archivo
                $filename = $estudio . '(' . ($index + 1) . ').' . $extension; // Renombrar el archivo con el ID del estudio y el número

                // Guardar el archivo en la carpeta correspondiente
                $archivo->move($folderPath, $filename);

                // Guardar la URL del archivo en la tabla 'multimedias'
                $url = 'uploads/estudios/' . $estudio . '/' . $filename;

                // Insertar en la base de datos, ahora guardando archivos de imágenes y videos
                DB::table('multimedias')->insert([
                    'id_estudio' => $estudio, // Asociar el archivo con el ID del estudio
                    'url' => $url,
                    'tipo' => in_array($extension, ['jpg', 'jpeg', 'png']) ? 'imagen' : 'video', // Determinar el tipo de archivo
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Redirigir a la página de pacientes con un mensaje de éxito
        return redirect()->route('pacientes')->with('estudioSuccess', 'Estudio agregado correctamente ✔');
    }


    public function pacienteEditarEstudio($id) {

        $estudio = DB::table('estudios')
            ->join('pacientes', 'estudios.id_paciente', '=', 'pacientes.id')
            ->join('tipos_estudios', 'estudios.id_tipo_estudio', '=', 'tipos_estudios.id')
            ->where('estudios.id', $id)
            ->select(
                'estudios.*', 
                'pacientes.apellido as paciente_apellido', 
                'pacientes.nombre as paciente_nombre', 
                'tipos_estudios.nombre as tipo_estudio_nombre'
            )
            ->first();

        $paciente = DB::table('pacientes')->where('id', $estudio->id_paciente)->first();

        $tipo_estudio =  DB::table('tipos_estudios')->where('id', $estudio->id_tipo_estudio)->first();    

        return view('virasoro.pacienteEditarEstudio', compact('estudio', 'paciente', 'tipo_estudio'));
    }   

    public function pacienteEditarEstudio2(Request $request) {

        DB::table('estudios')
            ->where('id', $request->input('estudio_id'))
            ->update([
                'fecha' => $request->input('fecha'),
                'solicitante' => $request->input('solicitante'),
                'informe' => $request->input('informe'),
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('edited', 'Estudio editado correctamente ✔');    

    }    

    public function estudioVer($id) {
        $estudio = DB::table('estudios')
            ->join('pacientes', 'estudios.id_paciente', '=', 'pacientes.id')
            ->join('tipos_estudios', 'estudios.id_tipo_estudio', '=', 'tipos_estudios.id')
            ->where('estudios.id', $id)
            ->select(
                'estudios.*', 
                'pacientes.apellido as paciente_apellido', 
                'pacientes.nombre as paciente_nombre', 
                'tipos_estudios.nombre as tipo_estudio_nombre'
            )
            ->first();

        $estudio->fecha = Carbon::parse($estudio->fecha)->format('d/m/Y');      

        $baseUrl = asset('');    

        $imagenes = DB::table('multimedias')
                  ->where('id_estudio', $id)
                  ->pluck('url')
                  ->map(fn($url) => $baseUrl . $url);

        return view('virasoro.estudioVer', compact('estudio', 'imagenes'));
    }

    public function estudioDescargar($id) {
        $estudio = DB::table('estudios')
            ->join('pacientes', 'estudios.id_paciente', '=', 'pacientes.id')
            ->join('tipos_estudios', 'estudios.id_tipo_estudio', '=', 'tipos_estudios.id')
            ->where('estudios.id', $id)
            ->select(
                'estudios.*',
                'pacientes.apellido as paciente_apellido',
                'pacientes.nombre as paciente_nombre',
                'tipos_estudios.nombre as tipo_estudio_nombre'
            )
            ->first();

        $estudio->fecha = Carbon::parse($estudio->fecha)->format('d/m/Y');     

        $imagenes = DB::table('multimedias')
            ->where('id_estudio', $id)
            ->select('url', 'tipo')
            ->get();

        $pdf = PDF::loadView('virasoro.estudioPdf', [
            'estudio' => $estudio,
            'imagenes' => $imagenes
        ]);

        $fecha = Carbon::createFromFormat('d/m/Y', $estudio->fecha)->format('d-m-Y');

        return $pdf->download($estudio->paciente_apellido . " " . $estudio->paciente_nombre . " (" . $estudio->tipo_estudio_nombre . " " . $fecha . ').pdf');
    }

    public function estudioImprimir($id) {
        $estudio = DB::table('estudios')
            ->join('pacientes', 'estudios.id_paciente', '=', 'pacientes.id')
            ->join('tipos_estudios', 'estudios.id_tipo_estudio', '=', 'tipos_estudios.id')
            ->where('estudios.id', $id)
            ->select(
                'estudios.*',
                'pacientes.apellido as paciente_apellido',
                'pacientes.nombre as paciente_nombre',
                'tipos_estudios.nombre as tipo_estudio_nombre'
            )
            ->first();

        $estudio->fecha = Carbon::parse($estudio->fecha)->format('d/m/Y');      

        $imagenes = DB::table('multimedias')
            ->where('id_estudio', $id)
            ->select('url', 'tipo')
            ->get();

        $pdf = PDF::loadView('virasoro.estudioPdf', [
            'estudio' => $estudio,
            'imagenes' => $imagenes
        ]);

        $fecha = Carbon::createFromFormat('d/m/Y', $estudio->fecha)->format('d-m-Y');

        return $pdf->stream($estudio->paciente_apellido . " " . $estudio->paciente_nombre . " (" . $estudio->tipo_estudio_nombre . " " . $fecha . ').pdf');
    }

    public function estudioEliminar($id) {

        DB::table('estudios')->where('id', $id)->delete();
        DB::table('multimedias')->where('id_estudio', $id)->delete();

        $folderPath = public_path('uploads/estudios/' . $id);
        File::deleteDirectory($folderPath);

        return redirect()->back()->with('deleted', 'Estudio eliminado correctamente ✔');
    }

    public function estudioEliminarB($id) {

        $id_paciente = DB::table('estudios')
                ->where('id', $id)
                ->value('id_paciente');       

        DB::table('estudios')->where('id', $id)->delete();
        DB::table('multimedias')->where('id_estudio', $id)->delete();

        $folderPath = public_path('uploads/estudios/' . $id);
        File::deleteDirectory($folderPath);

        return redirect()->route('pacienteLegajo', ['id' => $id_paciente])
                 ->with('deleted', 'Estudio eliminado correctamente ✔');
    }

        
}
