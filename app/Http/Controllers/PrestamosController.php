<?php

namespace App\Http\Controllers;

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
        return view('prestamos.create');
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

        $datosPrestamo = request()->except('_token');

        Prestamos::insert($datosPrestamo);

        //return response()->json($datosLibro);
        return redirect('prestamos')->with('mensaje', 'Prestamo guardado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestamo = Prestamos::findOrFail($id);
        return view('prestamos.show', compact('prestamos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestamo = Prestamos::findOrFail($id);
        return view('prestamos.edit', compact('prestamo'));
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

        $datosPrestamo = request()->except(['_token', '_method']);

        Prestamos::where('id', '=', $id)->update($datosPrestamo);
        $prestamo = Prestamos::findOrFail($id);

        return redirect('prestamos')->with('mensaje', 'Prestamo Modificado');
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
