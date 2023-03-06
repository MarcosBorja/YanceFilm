<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['peliculas']=Pelicula::paginate(5);

        return view('pelicula.index', $datos );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pelicula.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Actor'=>'required|string|max:100',
            'Genero'=>'required|string|max:100',
            'Director'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :atribute es requerido'
        ];

        $this->validate($request, $campos, $mensaje);

        $datosPelicula = request()->except('_token');

        Pelicula::insert($datosPelicula);

        //return response()->json($datosPelicula);
        return redirect('pelicula')->with('pelicula','Pelicula agregada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(Pelicula $pelicula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pelicula=Pelicula::findOrFail($id);
        return view('pelicula.edit', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Actor'=>'required|string|max:100',
            'Genero'=>'required|string|max:100',
            'Director'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :atribute es requerido'
        ];

        $this->validate($request, $campos, $mensaje);

        $datosPelicula = request()->except(['_token','_method']);
        Pelicula::where('id','=',$id)->update($datosPelicula);

        $pelicula=Pelicula::findOrFail($id);
        //return view('pelicula.edit', compact('pelicula'));
        return redirect('pelicula')->with('pelicula','Pelicula editada con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Pelicula::destroy($id);

        return redirect('pelicula')->with('pelicula','Pelicula borrada con exito');
    }
}
