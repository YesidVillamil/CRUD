<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['clientes'] = Cliente::paginate(5);
        return view('cliente.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'cedula' => 'required|string|max:100',
            'nombre' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El :attribute es necesario',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosCliente = request()->except('_token');

        Cliente::insert($datosCliente);

        return redirect('cliente')->with('mensaje', 'Cliente guardado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $campos = [
            'cedula' => 'required|string|max:100',
            'nombre' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El :attribute es necesario',
        ];


        $this->validate($request, $campos, $mensaje);

        $datosCliente = request()->except(['_token', '_method']);

        Cliente::where('id', '=', $id)->update($datosCliente);
        $cliente = Cliente::findOrFail($id);

        return redirect('cliente')->with('mensaje', 'Cliente Modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        Cliente::destroy($id);

        return redirect('cliente')->with('mensaje', 'Cliente eliminado');
    }
}
