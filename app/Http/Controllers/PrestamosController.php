<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Libro;
use App\Models\Prestamos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['prestamos'] = Prestamos::paginate(5);
        return view('prestamos.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $clientes = Cliente::all();
        $libros = Libro::all();
        return view('prestamos.create', compact('clientes', 'libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'cedula' => 'required|string|max:100',
            'titulo' => 'required|string|max:100',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El :attribute es necesario',
        ];

        $this->validate($request, $campos, $mensaje);

        // Verificar si el libro está disponible
        $libro = Libro::where('titulo', $request->titulo)->first();

        if ($libro && $libro->estado === 'Prestado') {
            return redirect()->back()->withErrors(['titulo' => 'El libro ya está prestado'])->withInput();
        }

        $datosPrestamo = $request->except('_token');

        Prestamos::insert($datosPrestamo);

        // Actualizar estado del libro
        if ($libro) {
            if ($request->estado === 'Asignado') {
                $libro->estado = 'Prestado';
            } elseif ($request->estado === 'Devuelto') {
                $libro->estado = 'Disponible';
            }
            $libro->save();
        }

        return redirect('prestamos')->with('mensaje', 'Préstamo guardado con éxito');
    }


    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        $campos = [
            'cedula' => 'required|string|max:100',
            'titulo' => 'required|string|max:100',
            'fecha' => 'required|date',
            'estado' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El :attribute es necesario',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosPrestamo = $request->except(['_token', '_method']);

        Prestamos::where('id', '=', $id)->update($datosPrestamo);

        // Actualizar estado del libro
        $libro = Libro::where('titulo', $request->titulo)->first();
        if ($libro) {
            if ($request->estado === 'Asignado') {
                $libro->estado = 'Prestado';
            } elseif ($request->estado === 'Devuelto') {
                $libro->estado = 'Disponible';
            }
            $libro->save();
        }

        return redirect('prestamos')->with('mensaje', 'Préstamo modificado');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $libro = Prestamos::findOrFail($id);

        Prestamos::destroy($id);

        return redirect('prestamos')->with('mensaje', 'Prestamo eliminado');
    }
}
