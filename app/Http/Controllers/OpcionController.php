<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opcion;

class OpcionController extends Controller
{
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $opciones = Opcion::all()->pluck('valor', 'nombre');
        
        foreach($opciones as $key => $opcion) {
            if($opcion) {
                $opciones[$key] = '2019-'.$opcion;
            }
        }
        
        return view('opciones.edit', compact('opciones') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        foreach( $request->except('_method', '_token') as $key => $fecha ) {
            $opcion = Opcion::where('nombre', $key)->first();
            if($opcion) {
                $opcion->valor = ($fecha)? substr($fecha, 5) : null;
                $opcion->save();
            }
        }
        
        return back()->with('success', 'Las opciones se actualizarón correctamente.');
      
    }

}
