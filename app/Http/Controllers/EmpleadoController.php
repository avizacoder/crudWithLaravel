<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date['empleados'] = Empleado::paginate(10);
        return view('empleado.index', $date);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$dateEmpleado = request()->all();
        $dateEmpleado = request()->except('_token');

        if($request->hasFile('photo')) {
            $dateEmpleado['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        Empleado::insert($dateEmpleado);

        return redirect('empleado')->with('message', 'Empleado agregado con exito');
        //return response()->json($dateEmpleado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $campos= [
            'name' => 'required|string|max:100',
            'lastNameP' => 'required|string|max:100',
            'lastNameM' => 'required|string|max:100',
            'email' => 'required|email',
            'photo' => 'required|max:10000|nimes:jpeg,png,jpg',
        ];

        $message=[
            'required'=> 'The :attribute is required',
            'photo.required'=>'The photo is required',
        ];
        

        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dateEmpleado = request()->except(['_token','_method']);


        $campos= [
            'name' => 'required|string|max:100',
            'lastNameP' => 'required|string|max:100',
            'lastNameM' => 'required|string|max:100',
            'email' => 'required|email',
            
        ];

        $message=[
            'required'=> 'The :attribute is required',
            
        ];

        if($request->hasFile('photo')) {
            $campos =['photo' => 'required|max:10000|nimes:jpeg,png,jpg'];
            $message=['photo.required'=>'The photo is required'];
        }

        $this->validate($request,$campos,$message);


        if($request->hasFile('photo')) {

            $empleado=Empleado::findOrFail($id);

            Storage::delete('public/'.$empleado->photo);
            
            $dateEmpleado['photo'] = $request->file('photo')->store('uploads', 'public');
        } 

        Empleado::where('id','=', $id)->update($dateEmpleado);

        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('message', 'Empleado Modificado');

        //https://www.youtube.com/watch?v=9DU7WLZeam8
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->photo)) {
            Empleado::destroy($id);
        }
        
        return redirect('empleado')->with('message', 'Empleado borrado');
    }
}
