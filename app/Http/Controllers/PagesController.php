<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PagesController extends Controller
{
    public function inicio(){
        //$notas = App\Nota::all();
        $notas = App\Nota::paginate(6);
    	return view('pruebas.welcome', compact('notas'));
    }

    public function bienvenido(){
    	 return "Hola!!";
    }

    public function detalle($id){
       $nota = App\Nota::findOrFail($id); //findOrFail importante usarlo y NO la funcion ::find($id)
        return view('notas.detalle', compact('nota'));
    }

    public function crear(Request $request){
        // return $request->all();

        $request->validate([
            'nombre' => 'required',
            'descripcion'=>'required'
        ]);

        $notaNueva = new App\Nota;
        $notaNueva->nombre = $request->nombre;
        $notaNueva->descripcion = $request->descripcion;

        $notaNueva->save();

        return back()->with('mensaje', 'Nota agregada!!');
    }

    public function editar($id){
        $nota = App\Nota::findOrFail($id);
        return view('notas.editar', compact('nota'));
    }

    public function update(Request $request, $id){
         $request->validate([
            'nombre' => 'required',
            'descripcion'=>'required'
        ]);

        $notaUpdate = App\Nota::findOrFail($id);
        $notaUpdate->nombre = $request->nombre;
        $notaUpdate->descripcion = $request->descripcion;

        $notaUpdate->save();

        return back()->with('mensaje', 'Nota Actualizada!!');
    }

    public function eliminar($id){
        $notaEliminar = App\Nota::findOrFail($id);
        $notaEliminar->delete();
        return back()->with('mensaje','Nota Eliminada!');
    }

    public function fotos(){
    	return view('pruebas.fotos');
    }

    public function blog(){
    	return view('pruebas.blog');
    }

    public function nosotros($nombre = null){
		$equipo = ['Deivie','Oscar','Jhonkeily'];

		return view('pruebas.nosotros',['equipo'=>$equipo, 'nombre'=>$nombre]);
		//return view('prueba.nosotros',compact('equipo'));
    }
}
