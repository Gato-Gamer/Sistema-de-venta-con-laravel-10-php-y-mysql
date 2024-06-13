@extends('layouts.admin')
@section('contenido')
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Agregar Mueble</h3>
            </div>

            <form action="{{ route('categoria.store')}}" method="POST" class="form">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre del mueble">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Material</label>
                        <input type="text" class="form-control" name="material" id="material" placeholder="Ingresa el material">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="text" class="form-control" name="precio" id="precio" placeholder="Ingresa el precio">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="text" class="form-control" name="imagen" id="imagen" placeholder="Ingresa la imagen">
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
