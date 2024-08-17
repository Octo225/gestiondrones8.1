@extends('layouts.app')
@section('title', 'Editar Material')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Tarjeta para editar el material -->
            <div class="card">
                <!-- Encabezado de la tarjeta -->
                <div class="card-header">Editar Material</div>

                <!-- Cuerpo de la tarjeta -->
                <div class="card-body">
                    <!-- Mostrar errores de validación si existen -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Formulario para actualizar el material -->
                    <form action="{{ route('Material.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Campo para el número de serie -->
                        <div class="form-group">
                            <label for="id">Número de serie:</label>
                            <input type="text" id="id" name="id" class="form-control" required value="{{ old('id', $material->id) }}">
                        </div>
                        <!-- Campo para el folio -->
                        <div class="form-group">
                            <label for="Folio_Conalep">Folio:</label>
                            <input type="text" id="Folio_Conalep" name="Folio_Conalep" class="form-control" required value="{{ old('Folio_Conalep', $material->Folio_Conalep) }}">
                        </div>
                        <!-- Campo para el nombre -->
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required value="{{ old('nombre', $material->nombre) }}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" required value="{{ old('descripcion', $material->descripcion) }}">
                        </div>
                        <br>
                        <!-- Campo para la imagen -->
                        <div class="form-group">
                            <label for="imagen">Imagen (solo JPG):</label>
                            <div class="input-group">
                                <input type="file" id="imagen" name="imagen" class="form-control" accept="image/jpeg">
                                <div class="input-group-append">
                                    <button type="button" id="clearImage" class="btn btn-secondary">limpiar</button>
                                </div>
                            </div>
                            @if ($material->imagen)
                                <div class="mt-2">
                                    <!-- Mostrar la imagen actual si existe -->
                                    <img src="data:image/jpeg;base64,{{ $material->imagen }}" alt="Imagen del material" width="100px" height=100px>
                                    <button type="button" class="btn btn-danger" id="eliminar_imagen_btn">Quitar Imagen</button>
                                </div>
                            @endif
                        </div>
                        <br>
                        <!-- Botones de acción -->
                        <div class="tooltip-container">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="javascript:history.back()" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                    <!-- Formulario para eliminar la imagen -->
                    <form id="eliminar_imagen_form" action="{{ route('Material.removeImage', $material->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
