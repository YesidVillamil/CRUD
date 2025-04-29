<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function estadisticas()
    {
        $prestados = Libro::where('estado', 'Prestado')->count();
        $disponibles = Libro::where('estado', 'Disponible')->count();

        return view('libro.estadisticas', compact('prestados', 'disponibles'));
    }

    public function index()
    {
        $datos['libros'] = Libro::paginate(5);
        return view('libro.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'genero' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El :attribute es necesario',
        ];

        $this->validate($request, $campos, $mensaje);
        //$datosLibro = request()->all();
        $datosLibro = request()->except('_token');

        Libro::insert($datosLibro);

        //return response()->json($datosLibro);
        return redirect('libro')->with('mensaje', 'Libro guardado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $libro = Libro::findOrFail($id);
        return view('libro.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        return view('libro.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $campos = [
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'genero' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El :attribute es necesario',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosLibro = request()->except(['_token', '_method']);

        Libro::where('id', '=', $id)->update($datosLibro);
        $libro = Libro::findOrFail($id);
        //return view('libro.edit', compact('libro'));

        return redirect('libro')->with('mensaje', 'Libro Modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);

        Libro::destroy($id);

        return redirect('libro')->with('mensaje', 'Libro eliminado');
    }
}
