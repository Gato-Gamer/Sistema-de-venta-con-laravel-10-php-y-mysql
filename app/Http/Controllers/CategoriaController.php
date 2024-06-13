<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request)
        {
            $query=trim($request->get('texto'));
            $categorias=DB::table('mueble')->where('nombre','LIKE','%'.$query.'%')
            //->where('estatus', '=', '1')
            ->orderBy('id', 'desc')
            ->paginate(7);
            return view('almacen.categoria.index',["categoria"=>$categorias,"texto"=>$query]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("almacen.categoria.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaFormRequest $request)
    {
        //
        $categoria=new Categoria;
        $categoria->nombre=$request->get('nombre');
        $categoria->material=$request->get('material');
        $categoria->precio=$request->get('precio');
        $categoria->imagen=$request->get('imagen');
        $categoria->save();
        return Redirect::to('almacen/categoria');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaFormRequest $request,$id)
    {
        //
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->material=$request->get('material');
        $categoria->precio=$request->get('precio');
        $categoria->imagen=$request->get('imagen');
        $categoria->update();
        
        return Redirect::to('almacen/categoria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $categoria=Categoria::findOrFail($id);
        $categoria->delete();
        $categoria->update();
        /* return Redirect::to('almacen/categoria'); */
        return redirect()->route('categoria.index')
                    ->with('success', 'Categoría eliminada correctamente');

    }
}
