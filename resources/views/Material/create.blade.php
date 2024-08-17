@extends('layouts.app')
@section('title', 'Crear Nuevo Material')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Tarjeta que contiene el formulario para crear un nuevo material -->
            <div class="card">
                <!-- Encabezado de la tarjeta -->
                <div class="card-header">Crear Nuevo Material</div>

                <!-- Cuerpo de la tarjeta -->
                <div class="card-body">
                    <!-- Si hay errores de validación, mostrarlos en una alerta -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario para crear un nuevo material -->
                    <form id="materialForm" action="{{ route('Material.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token de seguridad para el formulario -->

                        <!-- Campo para el número de serie -->
                        <div class="form-group">
                            <label for="id">Número de serie:</label>
                            <input type="text" id="id" name="id" class="form-control" required value="{{ old('id') }}">
                        </div>

                        <!-- Campo para el folio -->
                        <div class="form-group">
                            <label for="Folio_Conalep">Folio:</label>
                            <input type="text" id="Folio_Conalep" name="Folio_Conalep" class="form-control" required value="{{ old('Folio_Conalep') }}">
                        </div>

                        <!-- Campo para el nombre del material -->
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required value="{{ old('nombre') }}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" required value="{{ old('descripcion') }}">
                        </div>
                        <br>

                        <!-- Campo para subir una imagen del material -->
                        <div class="form-group">
                            <label for="imagen">Imagen (solo JPG):</label>
                            <div class="input-group">
                                <input type="file" id="imagen" name="imagen" class="form-control" accept=".jpg" >
                                <div class="input-group-append">
                                    <button type="button" id="clearImage" class="btn btn-secondary">Quitar imagen</button>
                                </div>
                            </div>
                        </div>

                        <!-- Botones para enviar el formulario o cancelar la acción -->
                        <div class="tooltip-container">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="javascript:history.back()" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
