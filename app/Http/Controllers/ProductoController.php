<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoFormRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use illuminate\support\Str;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        
    }
    
    public function index(Request $request)
    {
        //
        
            $texto=trim($request->get('texto'));
            $productos=DB::table('producto as a')
            ->join('categoria as c', 'a.id_categoria', '=', 'c.id')
            ->select('a.id_producto', 'a.nombre', 'a.cogigo', 'a.stock', 'c.categoria', 'a.descripcion', 'a.imagen', 'a.estado')
            ->where('a.nombre','LIKE','%'.$texto.'%')
            ->orwhere('a.cogigo', 'LIKE', '%'.$texto.'%')
            ->orderBy('id_producto', 'desc')
            ->paginate(10);
            return view('almacen.producto.index', compact('productos', 'texto'));
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias=DB::table('categoria')->where('estatus','=','1')->get();
        return view("almacen.producto.create",["categoria"=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoFormRequest $request)
    {
        //
        $producto=new Producto();
        $producto->id_categoria=$request->input('id_categoria');
        $producto->cogigo=$request->input('cogigo');
        $producto->nombre=$request->input('nombre');
        $producto->stock=$request->input('stock');
        $producto->descripcion=$request->input('descripcion');
        
        $producto->estado='Activo';
//script para subir imagen
        if($request->hasFile("imagen")){
            $imagen=$request->file("imagen");
            $nombreimagen = Str::slug($request->nombre).".".$imagen->guessExtension();
          
            $ruta=public_path("/imagenes/productos/");

            copy($imagen->getRealPath(),$ruta.$nombreimagen);

            $producto->imagen=$nombreimagen;
        }

        $producto->save();
        return Redirect::route('producto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $producto=Producto::findOrFail($id);
        $categorias=DB::table('categoria')->where('estatus','=','1')->get();
        return view("almacen.producto.edit",["producto"=>$producto, "categorias"=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoFormRequest $request,$id)
    {
        //
        $producto=Producto::findOrFail($id);
        $producto->id_categoria=$request->input('id_categoria');
        $producto->cogigo=$request->input('cogigo');
        $producto->nombre=$request->input('nombre');
        $producto->stock=$request->input('stock');
        $producto->descripcion=$request->input('descripcion');
        //imagen
        if($request->hasFile("imagen")){
            $imagen=$request->file("imagen");
            $nombreimagen = Str::slug($request->nombre).".".$imagen->guessExtension();
          
            $ruta=public_path("/imagenes/productos/");
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
            $producto->imagen=$nombreimagen;
        }

        $producto->update();
        return redirect()->route('producto.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $producto=Producto::findOrFail($id);
        $producto->estado='inactivo';
        $producto->update();
        return redirect()->route('producto.index');
        
    }
}
