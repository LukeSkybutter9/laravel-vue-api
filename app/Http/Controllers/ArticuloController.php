<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Articulo::all());
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
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
        $request->validate([
            'name' => 'required|string|max:255|unique:articulos,name',
            'content' => 'required|string',
            'status' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image|max:2048',
        ]);

        $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));

        $articuloEncontrado = Articulo::where('name', $request->name)->first();

        if(!$articuloEncontrado){ //verificar que el articulo no exista
            $articulo = Articulo::create([
            'name' => $request->name,
            'content' => $request->content,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'image' => $imageData, // Imagen en base64
            ]); 
        }else{
            return response()->json(['message' => 'El articulo ya existe'], 422);
        }

        return response()->json(['message' => 'Articulo creado correctamente', ' articulo' => $articulo], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Articulo::find($id);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $articulo = Articulo::find($id);
        if($articulo){
            $articulo->update($request->all());
        }else{
            return response()->json(['error' => 'Articulo no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Articulo::destroy($id);
    }
}
