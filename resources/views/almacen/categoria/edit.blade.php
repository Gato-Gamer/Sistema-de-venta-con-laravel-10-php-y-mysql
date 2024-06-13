@extends('layouts.admin')
@section('contenido')
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Mueble {{$categoria->nombre}}</h3>
            </div>

            <form action="{{ route('categoria.update', $categoria->id)}}" method="POST" class="form">
            @csrf
            @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="nomnbre">Nombre</label>
                        <input type="text" class="form-control" name="nomnbre" id="nomnbre" value="{{$categoria->nombre}}" placeholder="Ingresa el nombre del mueble">
                    </div>
                    <div class="form-group">
                        <label for="material">Material</label>
                        <input type="text" class="form-control" name="material" id="material" value="{{$categoria->material}}" placeholder="Ingresa el material">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="text" class="form-control" name="precio" id="precio" value="{{$categoria->precio}}" placeholder="Ingresa el precio">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="text" class="form-control" name="imagen" id="imagen" value="{{$categoria->imagen}}" placeholder="Ingresa la imagen">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                        <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
