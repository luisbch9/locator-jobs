<?php

namespace App\Http\Controllers;

use App\Trabajo;
use App\User;
use App\Foto;
use Auth;
use Illuminate\Http\Request;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $trabajos  = [];

        if(Auth::user()->trabajador){
            $trabajos = Auth::user()->trabajador->trabajos;
            //dd($trabajos);
            return view('dashboard.dashboard', ['trabajos' => $trabajos]);        
        }
        return view('dashboard.dashboard', ['trabajos' => $trabajos]);

    }

    /**
     * Muestra el trabajo solicitado
     *
     */

    public function index2($id)
    {

        $t = Trabajo::find($id);
        //dd($t->location);

        //dd($t);
        return view('dashboard.trabajosForm', ['t' => $t]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       //dd(Auth::user()->trabajador);
       return view('dashboard.trabajosFormNew');
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
        //dd($request);
        //return dd($request);


        $trabajo= new Trabajo;
        $trabajo->nombre=$request->nombre;
        $trabajo->location=$request->location;
        $trabajo->descripcion=$request->descripcion;
        $trabajo->trabajador_id=Auth::user()->trabajador->id;
        $trabajo->save();

        $fun =  function ($val){
            return (array)$val;
        };
       
        if(!is_null($request->fotos)){
            $fs = json_decode($request->fotos);
            $fsa = array_map($fun , $fs);


            //dd($fs);
            //print_r($fsa);
            //dd($fsa);
            $comment = $trabajo->fotos()->createMany($fsa);
        }
        

        return redirect("dashboard");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajo $trabajo)
    {
        return view('Trabajos.mostrar',['trabajo'=>$trabajo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(Trabajo $trabajo)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trabajo $trabajo)
    {
        $trabajo->nombre=$request->nombre;
        $trabajo->ubicacion=$request->ubicacion;
        $trabajo->descripcion=$request->descripcion;
        $trabajo->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajo $trabajo)
    {
        //
    }
}
