<?php

namespace App\Http\Controllers;

use DB;
use App\Trabajo;
use App\Trabajador;
use App\Contrato;
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


    public function getTrabajo(Request $request)
    {
        //$trabajos= DB::table('trabajos')->select(DB::raw('id, nombre, asText(location), descripcion'))
        //->where('nombre','like','%asd%')
        //->where()
        //->get();
        $trabajos= Trabajo::distance(0.02,$request->pos)->where('nombre','like','%'.$request->nombre.'%')->get();
    }

    public function busqueda(Request $request)
    {
        //return $request->pos;
        if ($request->pos)
        {
            $trabajos= Trabajo::distance(0.02,$request->pos)->where('nombre','like','%'.$request->data.'%')->get();
            return view('busqueda',["data"=>$request->data,'origen'=>$request->pos,"trabajos"=>$trabajos]);
        }
        else
        {
            return view('busqueda');
        }
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
//      dd($trabajo->trabajador_id->descripcion);
        $trabajador = Trabajador::find($trabajo->trabajador_id);


        $user = User::find($trabajador->user_id);
        $fotos = DB::table('fotos_trabajos')
                ->where('trabajo_id', $trabajo->id)
                ->get();



            //    dd(sizeof($fotos));

        //dd($trabajador->user_id);
        return view('trabajos.mostrar',['trabajo'=>$trabajo, 'trabajador'=> $trabajador,'user'=>$user,'fotos'=>$fotos]);
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


    public function linea()
    {
       return view('linea.linea');
    }


    public function lineaP()
    {
      $trabajador =  Auth::user()->trabajador;
      //dd($trabajador->trabajos);
      $n = $trabajador->trabajos;
      //dd($n[0]->fotos[0]);
      $trabajosP = DB::table('trabajos')
              ->where('trabajador_id', $trabajador->id)
              ->orderBy('created_at', 'desc')
              ->get();
//              dd($trabajosP[0]->created_at);
      $fechas=array();
      $fechas2 = array();
      foreach ($trabajosP as $trabajo) {
        array_push($fechas,$trabajo->created_at);
      }
      foreach ($fechas as $fecha) {
        $porciones = explode(" ",$fecha);
        $porciones[1] = substr($porciones[1], 0, -3);
        array_push($fechas2,$porciones);
      }
      return view('linea.lineaP',["trabajador"=>$trabajador,"trabajos"=>$trabajosP,"fechas"=>$fechas2,"fotos"=>$n]);

    }
    public function lineaC()
    {
      //trabajos Contratados
      $userC = Auth::user();
      $trabajosC = DB::table('contratos')
              ->where('user_id', $userC->id)
              ->orderBy('created_at', 'desc')
              ->get();
      $fechas=array();
      $fechas2 = array();
      foreach ($trabajosC as $trabajo) {
        array_push($fechas,$trabajo->created_at);
      }
      foreach ($fechas as $fecha) {
        $porciones = explode(" ",$fecha);
        $porciones[1] = substr($porciones[1], 0, -3);
        array_push($fechas2,$porciones);
      }

      if (sizeof($trabajosC)!=0) {
        return view('linea.lineaC',["user"=>$userC,"trabajos"=>$trabajosC,"fechas"=>$fechas2,"bool"=>true]);
      }
      else {
        return view('linea.lineaC',['bool'=>false]);
      }
    }
    public function lineaR()
    {
      $trabajador =  Auth::user()->trabajador;

      $contratosR = DB::table('contratos')
              ->where('trabajador_id', $trabajador->id)
              ->orderBy('created_at', 'desc')
              ->get();
      $fechas=array();
      $fechas2 = array();
      foreach ($contratosR as $contrato) {
        array_push($fechas,$trabajo->created_at);
      }
      foreach ($fechas as $fecha) {
        $porciones = explode(" ",$fecha);
        $porciones[1] = substr($porciones[1], 0, -3);
        array_push($fechas2,$porciones);
      }

      return view('linea.lineaR');
    }
}
