@extends('layouts.app')
@section('title', 'Editar Préstamo')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-black">Editar Préstamo</div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                <!-- Mostrar los errores de validación -->
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario para editar el préstamo -->
                    <form action="{{ route('Prestamo.update', $prestamo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Nombre_alumno">Nombre del Alumno:</label>
                            <select class="form-select js-example-basic-single" name="Nombre_alumno" id="Nombre_alumno" required>
                                <option value="">Selecciona o escribe un Alumno</option>
                                <!-- Opciones para seleccionar el nombre del alumno -->
                                @foreach($alumnos as $alumno)
                                    <option value="{{ $alumno->Nombre }}" {{ $alumno->Nombre == $prestamo->Nombre_alumno ? 'selected' : '' }}>{{ $alumno->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Carrera">Carrera:</label>
                            <select class="form-select js-example-basic-single" name="Carrera" id="Carrera" required>
                                <option value="">Selecciona o escribe una carrera</option>
                                <!-- Opciones para seleccionar la carrera -->
                                @foreach($carreras as $carrera)
                                    <option value="{{ $carrera->Carrera }}" {{ $carrera->Carrera == $prestamo->Carrera ? 'selected' : '' }}>{{ $carrera->Carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Grupo">Grupo:</label>
                            <select class="form-select js-example-basic-single" name="Grupo" id="Grupo" required>
                                <option value="">Selecciona o escribe un Grupo</option>
                                <!-- Opciones para seleccionar el grupo -->
                                @foreach($grupos as $grupo)
                                    <option value="{{ $grupo->Nombre }}" {{ $grupo->Nombre == $prestamo->Grupo ? 'selected' : '' }}>{{ $grupo->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Material_Folio">Material Prestado:</label>
                            <select class="form-select js-example-basic-single" name="Material_Folio" id="Material_Folio" required>
                                <option value="">Selecciona o escribe un material</option>
                                <!-- Opciones para seleccionar el material prestado -->
                                @foreach($materiales as $material)
                                    <option value="{{ $material->Folio_Conalep }}" {{ $material->Folio_Conalep == $prestamo->Material_Folio ? 'selected' : '' }}>{{ $material->Folio_Conalep }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Fecha_hora">Fecha y Hora:</label>
                            <input type="datetime-local" id="Fecha_hora" name="Fecha_hora" class="form-control" value="{{ old('Fecha_hora', date('Y-m-d\TH:i', strtotime($prestamo->Fecha_hora))) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="Descripcion">Descripción:</label>
                            <textarea id="Descripcion" name="Descripcion" class="form-control" rows="3" required>{{ old('Descripcion', $prestamo->Descripcion) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="Cantidad">Cantidad:</label>
                            <input type="number" id="Cantidad" name="Cantidad" class="form-control" value="{{ old('Cantidad', $prestamo->Cantidad) }}" required min="1" max="100">
                        </div>
                        <br>
                        <div class="tooltip-container">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="javascript:history.back()" class="btn btn-danger">Cancelar</a>
                            <span class="tooltip-text">Haz clic para actualizar</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
