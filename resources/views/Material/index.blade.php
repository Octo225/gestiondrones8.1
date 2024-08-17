@extends('layouts.app')
@section('title', 'Lista de Materiales')

@section('content')
<div class="container">

    <!-- Botón para crear un nuevo material -->
    <div class="row mb-3">
        <div class="col text-end">
            <div class="tooltip-container">
                <!-- Enlace para crear un nuevo material -->
                <a class="btn btn-primary" href="{{ route('Material.create') }}" title="Crear nuevo material">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                    <path d="M12 5v7h7v2h-7v7h-2v-7h-7v-2h7v-7z"/>
                </svg>
                </a>
                <span class="tooltip-text">Haz clic para crear un nuevo Material</span>
            </div>
            <div class="tooltip-container">
            <!-- Botón para crear un PDF de todos los préstamos -->
            <a class="btn btn-primary" href="{{ route('Material.pdfTodos') }}" title="Crear pdf con todos los mmateriales" data-bs-toggle="tooltip" data-bs-placement="top">
                <img src="{{ asset('svg/pdf-document-svgrepo-com.svg') }}" alt="Generar PDF" width="18" height="18">
            </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Tarjeta que contiene la lista de materiales -->
            <div class="card">
                <!-- Encabezado de la tarjeta -->
                <div class="card-header">Lista de Materiales</div>

                <!-- Cuerpo de la tarjeta con un contenedor para el scroll -->
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    <!-- Tabla para mostrar la lista de materiales -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Folio</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Iterar sobre la colección de materiales -->
                            @foreach($materials as $material)
                            <tr>
                                <!-- Mostrar el ID del material -->
                                <td>{{ $material->id }}</td>
                                <!-- Mostrar el nombre del material -->
                                <td>{{ $material->nombre }}</td>
                                <!-- Mostrar el folio del material -->
                                <td>{{ $material->descripcion }}</td>
                                <!-- Mostrar el folio del descripcion -->
                                <td>{{ $material->Folio_Conalep }}</td>
                                <!-- Mostrar la imagen del material si existe -->
                                <td>
                                    @if($material->imagen)
                                    <img src="data:image/jpeg;base64,{{ $material->imagen }}" alt="Imagen del material" width="100px" height=100px>
                                    @else
                                        Sin imagen
                                    @endif
                                </td>
                                <!-- Acciones disponibles para cada material -->
                                <td>
                                    <div class="tooltip-container">
                                        <!-- Enlace para editar el material -->
                                        <a class="btn btn-success" href="{{ route('Material.edit', ['material' => $material->id]) }}">Editar</a>
                                        <span class="tooltip-text">Editar este material</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
