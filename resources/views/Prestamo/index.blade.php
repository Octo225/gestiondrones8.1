@extends('layouts.app')
@section('title', 'Lista de Préstamos')

@section('content')

<div class="container">

    <div class="col text-end">
        <div class="tooltip-container">
            <!-- Botón para crear un nuevo préstamo -->
            <a class="btn btn-primary" href="{{ route('Prestamo.create') }}" title="Crear nuevo préstamo" data-bs-toggle="tooltip" data-bs-placement="top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                    <path d="M12 5v7h7v2h-7v7h-2v-7h-7v-2h7v-7z"/>
                </svg>
            </a>
        </div>
        <div class="tooltip-container">
            <!-- Botón para crear un PDF de todos los préstamos -->
            <a class="btn btn-primary" href="{{ route('Prestamo.pdfTodos') }}" title="Crear pdf con todos los préstamos" data-bs-toggle="tooltip" data-bs-placement="top">
                <img src="{{ asset('svg/pdf-document-svgrepo-com.svg') }}" alt="Generar PDF" width="18" height="18">
            </a>
        </div>
    </div>
    <br>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Préstamos
                    <!-- Tooltip para información adicional -->
                    <span id="infoTooltip" class="tooltip-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Haz clic para más información"></span>
                </div>
                <div class="card-body">
                    <!-- Formulario para filtrar la lista de préstamos -->
                    <form method="GET" action="{{ route('Prestamo.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col">
                                <input type="number" name="filter[id]" class="form-control filter-input" placeholder="Filtrar ID" value="{{ request('filter.id') }}" min="1">
                            </div>
                            <div class="col">
                                <input type="text" name="filter[Nombre_alumno]" class="form-control filter-input" placeholder="Filtrar Nombre" value="{{ request('filter.Nombre_alumno') }}">
                            </div>
                            <div class="col">
                                <input type="datetime-local" name="filter[Fecha_hora]" class="form-control filter-input" placeholder="Filtrar Fecha y Hora" value="{{ request('filter.Fecha_hora') }}">
                            </div>
                            <div class="col">
                                <select name="filter[Estado]" class="form-control filter-input">
                                    <option value="" {{ request('filter.Estado') == '' ? 'selected' : '' }}>Filtrar Estado</option>
                                    <option value="Entregado" {{ request('filter.Estado') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                    <option value="Entregado con daño" {{ request('filter.Estado') == 'Entregado con daño' ? 'selected' : '' }}>Entregado con daño</option>
                                    <option value="Pendiente" {{ request('filter.Estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="text" name="filter[Detalle]" class="form-control filter-input" placeholder="Filtrar Defecto" value="{{ request('filter.Detalle') }}">
                            </div>
                            <div class="col">
                                <input type="text" name="filter[Material_Folio]" class="form-control filter-input" placeholder="Filtrar Material" value="{{ request('filter.Material_Folio') }}">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Filtrar">Filtrar</button>
                            </div>
                            <div class="col">
                                <!-- Botón para eliminar los filtros -->
                                <div class="tooltip-container">
                                    <a class="btn btn-danger w-100" href="{{ route('Prestamo.index') }}" title="Quitar filtros" data-bs-toggle="tooltip" data-bs-placement="top">Quitar Filtros</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table" id="prestamosTable">
                            <thead>
                                <tr>
                                    <!-- Botones para ordenar las columnas de la tabla -->
                                    <th>
                                        <form method="GET" action="{{ route('Prestamo.index') }}">
                                            @php
                                                // Detectar el orden actual para cambiar la flecha
                                                $isDesc = request()->get('order') === 'desc_id' || !request()->has('order');
                                                $newOrder = $isDesc ? 'asc_id' : 'desc_id';
                                                $arrowIcon = $isDesc ? 'down-arrow-svgrepo-com.svg' : 'up-arrow-svgrepo-com.svg';
                                            @endphp
                                            <button type="submit" name="order" value="{{ $newOrder }}" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $isDesc ? 'Orden descendente' : 'Orden ascendente' }}">
                                                <img src="{{ asset('svg/' . $arrowIcon) }}" width="18" height="18">
                                            </button>
                                        </form>
                                    </th>
                                    <th>
                                        <form method="GET" action="{{ route('Prestamo.index') }}">
                                            @php
                                                // Detectar el orden actual para cambiar entre A-Z y Z-A
                                                $isAlphabeticalDesc = request()->get('order') === 'alphabetical_desc' || !request()->has('order');
                                                $newAlphabeticalOrder = $isAlphabeticalDesc ? 'alphabetical_asc' : 'alphabetical_desc';
                                                $alphabeticalLabel = $isAlphabeticalDesc ? 'A-Z' : 'Z-A';
                                            @endphp
                                            <button type="submit" name="order" value="{{ $newAlphabeticalOrder }}" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Orden {{ $alphabeticalLabel }}">
                                                {{ $alphabeticalLabel }}
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Alumno</th>
                                    <th>Fecha y Hora</th>
                                    <th>Estado</th>
                                    <th>Defecto</th>
                                    <th>Material</th>
                                    <th>Editar</th>
                                    <th>Devolver</th>
                                    <th>Detalles</th>
                                    <th>Eliminar</th>
                                    <th>Generar PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Bucle a través de los préstamos y mostrar cada uno en una fila -->
                                @foreach($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $prestamo->id }}</td>
                                    <td>{{ $prestamo->Nombre_alumno }}</td>
                                    <td>{{ $prestamo->Fecha_hora }}</td>
                                    <td>{{ $prestamo->Estado }}</td>
                                    <td>{{ $prestamo->Detalle }}</td>
                                    <td>{{ $prestamo->Material_Folio }}</td>
                                    <td>
                                        <!-- Botón para editar el préstamo -->
                                        <div class="tooltip-container">
                                            <a class="btn btn-warning" href="{{ route('Prestamo.edit', ['prestamo' => $prestamo->id]) }}" title="Editar préstamo" data-bs-toggle="tooltip" data-bs-placement="top">Editar</a>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Botón para devolver el material prestado, activa un modal -->
                                        <div class="tooltip-container">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#devolucionModal{{ $prestamo->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Devolver Material">
                                                <img src="{{ asset('svg/arrow-return-svgrepo-com.svg') }}" alt="Devolver" width="18" height="18">
                                            </button>
                                            <span class="tooltip-text" data-bs-toggle="tooltip" data-bs-placement="top">Haz clic para devolver el material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Botón para mostrar más detalles sobre el préstamo, activa un modal -->
                                        <div class="tooltip-container">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detalleModal{{ $prestamo->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detalles del Préstamo">
                                                <img src="{{ asset('svg/info-svgrepo-com.svg') }}" alt="Detalles" width="18" height="18">
                                            </button>
                                            <span class="tooltip-text" data-bs-toggle="tooltip" data-bs-placement="top">Haz clic para ver más detalles</span>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Botón para eliminar el préstamo -->
                                        <div class="tooltip-container">
                                            <form method="POST" action="{{ route('Prestamo.destroy', ['prestamo' => $prestamo->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Préstamo" onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?')">
                                                    <img src="{{ asset('svg/delete-1487-svgrepo-com.svg') }}" alt="Eliminar" width="18" height="18">
                                                </button>
                                            </form>
                                            <span class="tooltip-text" data-bs-toggle="tooltip" data-bs-placement="top">Haz clic para eliminar el préstamo</span>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Botón para generar un PDF del préstamo -->
                                        <div class="tooltip-container">
                                            <form method="POST" action="{{ route('Prestamo.generarPdf') }}">
                                                @csrf
                                                <input type="hidden" name="prestamo_id" value="{{ $prestamo->id }}">
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Generar PDF">
                                                    <img src="{{ asset('svg/pdf-document-svgrepo-com.svg') }}" alt="Generar PDF" width="18" height="18">
                                                </button>
                                            </form>
                                            <span class="tooltip-text" data-bs-toggle="tooltip" data-bs-placement="top">Haz clic para generar el PDF</span>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Modal para mostrar más detalles -->
                                <div class="modal fade" id="detalleModal{{ $prestamo->id }}" tabindex="-1" aria-labelledby="detalleModalLabel{{ $prestamo->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detalleModalLabel{{ $prestamo->id }}">Detalles del Préstamo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Mostrar detalles del préstamo -->
                                                <p><strong>ID:</strong> {{ $prestamo->id}}</p>
                                                <p><strong>Nombre:</strong> {{ $prestamo->Nombre_alumno}}</p>
                                                <p><strong>Carrera:</strong> {{ $prestamo->Carrera }}</p>
                                                <p><strong>Grupo:</strong> {{ $prestamo->Grupo }}</p>
                                                <p><strong>Fecha de Préstamo:</strong> {{ $prestamo->Fecha_hora}}</p>
                                                <p><strong>Fecha de Devolución:</strong> {{ $prestamo->Fecha_devolucion}}</p>
                                                <p><strong>Cantidad:</strong> {{ $prestamo->Cantidad }}</p>
                                                <p><strong>Descripción:</strong> {{ $prestamo->Descripcion }}</p>
                                                <p><strong>Detalles del Material:</strong> {{ $prestamo->Detalle }}</p>
                                                <p><strong>Estado del Préstamo:</strong> {{ $prestamo->Estado }}</p>
                                                <p><strong>Folio del Material:</strong> {{ $prestamo->Material_Folio }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para la devolución del material -->
                                <div class="modal fade" id="devolucionModal{{ $prestamo->id }}" tabindex="-1" aria-labelledby="devolucionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="devolucionModalLabel">Devolver Material</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario para manejar la devolución del material prestado -->
                                                <form method="POST" action="{{ route('Prestamo.devolver', ['prestamo' => $prestamo->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="Estado" class="form-label">¿El material está dañado?</label>
                                                        <select name="Estado" id="Estado" class="form-select" onchange="toggleDetalleInput(this)">
                                                            <option value="Entregado">No está dañado</option>
                                                            <option value="Entregado con daño">Sí, está dañado</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="Detalle" class="form-label">Especificar daño (si está dañado)</label>
                                                        <input name="Detalle" type="text" class="form-control" id="Detalle" placeholder="Descripción del daño">
                                                    </div>
                                                    <div class="tooltip-container">
                                                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Guardar">Guardar</button>
                                                        <span class="tooltip-text" data-bs-toggle="tooltip" data-bs-placement="top">Haz clic para guardar</span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
