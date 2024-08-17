<?php

namespace App\Http\Controllers;

// Se incluyen los modelos y clases necesarias
use App\Models\Material;
use App\Models\Prestamo;
use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Carrera;
use Illuminate\Http\Request;
use PDF;

// Definición del controlador PrestamoController que extiende de Controller
class PrestamoController extends Controller
{
    // Constructor del controlador
    public function __construct()
    {
        // Aplicar middleware 'auth' a todas las rutas
        $this->middleware('auth');
    }

    public function generarPdfTodos()
    {
        // Obtener todos los préstamos
        $prestamos = Prestamo::all();
    
        // Verificar si hay préstamos para evitar errores
        if ($prestamos->isEmpty()) {
            $fechaAntigua = $fechaNueva = now()->format('Y-m-d'); // Fecha actual si no hay préstamos
        } else {
            // Obtener la fecha más antigua y la fecha más nueva
            $fechaAntigua = $prestamos->min('Fecha_hora');
            $fechaNueva = $prestamos->max('Fecha_hora');
            
            // Formatear las fechas sin hora
            $fechaAntigua = \Carbon\Carbon::parse($fechaAntigua)->format('Y-m-d');
            $fechaNueva = \Carbon\Carbon::parse($fechaNueva)->format('Y-m-d');
        }
    
        // Generar el PDF con la vista 'prestamo.pdf_todos' y los datos de los préstamos
        $pdf = PDF::loadView('Prestamo.pdf_todos', compact('prestamos'));
    
        // Descargar el PDF con el nombre específico
        return $pdf->download("Lista_Prestamos_{$fechaAntigua}_a_{$fechaNueva}.pdf");
    }    
    
    // Método para generar un PDF de un préstamo específico
    public function generarPdf(Request $request)
    {
        // Obtener el ID del préstamo desde la solicitud
        $prestamoId = $request->input('prestamo_id');
        // Buscar el préstamo por su ID
        $prestamo = Prestamo::findOrFail($prestamoId);
    
        // Formatear la fecha del préstamo sin la hora
        $fecha = \Carbon\Carbon::parse($prestamo->Fecha_hora)->format('Y-m-d');
    
        // Generar el PDF con la vista 'prestamo.pdf' y los datos del préstamo
        $pdf = PDF::loadView('prestamo.pdf', compact('prestamo'));
        
        // Descargar el PDF con el nombre específico
        return $pdf->download("Prestamo_{$fecha}_{$prestamo->id}.pdf");
    }
    
    // Método para mostrar la lista de préstamos con filtros y ordenamiento
    public function index(Request $request)
    {
        // Crear una nueva consulta para el modelo Prestamo
        $query = Prestamo::query();

        // Aplicar filtros si existen
        if ($request->has('filter')) {
            $filters = $request->input('filter');
            foreach ($filters as $column => $value) {
                if (!empty($value)) {
                    if ($column == 'Estado') {
                        $query->where($column, $value);
                    } else {
                        $query->where($column, 'like', '%' . $value . '%');
                    }
                }
            }
        }

        // Aplicar ordenamiento por defecto ascendente por ID
        if ($request->has('order') && $request->input('order') == 'asc_id') {
            $query->orderBy('id', 'desc');
        } else if ($request->has('order') && $request->input('order') == 'desc_id') {
            $query->orderBy('id', 'asc');
        }

        // Verificar si se solicita ordenamiento alfabético
        if ($request->has('order') && $request->input('order') == 'alphabetical_asc') {
            $query->orderBy('Nombre_alumno', 'desc');
        } else if ($request->has('order') && $request->input('order') == 'alphabetical_desc') {
            $query->orderBy('Nombre_alumno', 'asc');
        }

        // Obtener los préstamos filtrados y ordenados
        $prestamos = $query->get();

        // Retornar la vista 'Prestamo.index' con los préstamos obtenidos
        return view('Prestamo.index', compact('prestamos'));
    }

    // Método para mostrar el formulario de creación de préstamo
    public function create()
    {
        // Obtener todos los materiales, carreras, alumnos y grupos
        $materiales = Material::all();
        $carreras = Carrera::all(); 
        $alumnos = Alumno::all(); 
        $grupos = Grupo::all();
        // Retornar la vista 'Prestamo.create' con los datos obtenidos
        return view('Prestamo.create', compact('materiales', 'carreras', 'alumnos', 'grupos'));
    }

    // Método para almacenar un nuevo préstamo
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'Nombre_alumno' => 'required|string|max:255',
            'Carrera' => 'required|string|max:50',
            'Grupo' => 'required|string|max:50',
            'Fecha_hora' => 'required',
            'Cantidad' => 'required|integer|min:1|max:100',
            'Descripcion' => 'required|string',
            'Estado' => 'nullable',
            'Fecha_devolucion' => 'nullable',
            'Material_Folio' => 'required|string', 
            'Detalle' => 'nullable|string|max:50', 
        ]);

        // Buscar el material por su Folio_Conalep
        $material = Material::where('Folio_Conalep', $request->input('Material_Folio'))->first();

        if ($material) {
            // Crear una nueva instancia del modelo Prestamo
            $prestamo = new Prestamo();
            // Asignar los valores de los campos del formulario al objeto Prestamo
            $prestamo->Nombre_alumno = $request->input('Nombre_alumno');
            $prestamo->Carrera = $request->input('Carrera');
            $prestamo->Grupo = $request->input('Grupo');
            $prestamo->Fecha_hora = $request->input('Fecha_hora');
            $prestamo->Cantidad = $request->input('Cantidad');
            $prestamo->Descripcion = $request->input('Descripcion');
            $prestamo->Estado = 'Pendiente';
            $prestamo->Fecha_devolucion = 'No entregado';
            $prestamo->Material_Folio = $request->input('Material_Folio');
            $prestamo->Detalle = 'Ninguno';

            // Guardar el préstamo en la base de datos
            $prestamo->save();

            // Establecer un mensaje de éxito en la sesión
            session()->flash('success', 'Préstamo creado correctamente');
        } else {
            // Establecer un mensaje de error en la sesión si no se encuentra el material
            session()->flash('error', 'No se pudo encontrar el material especificado');
        }

        // Redirigir a la ruta 'Prestamo.index'
        return redirect()->route('Prestamo.index');
    }
    
    // Método para mostrar el formulario de edición de préstamo
    public function edit(Prestamo $prestamo)
    {
        // Obtener todos los materiales, carreras, alumnos y grupos
        $materiales = Material::all();
        $carreras = Carrera::all(); 
        $alumnos = Alumno::all(); 
        $grupos = Grupo::all();
        // Retornar la vista 'Prestamo.edit' con los datos obtenidos y el préstamo especificado
        return view('Prestamo.edit', compact('materiales', 'carreras', 'alumnos', 'grupos', 'prestamo'));
    }

    // Método para actualizar un préstamo existente
    public function update(Request $request, Prestamo $prestamo)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'Nombre_alumno' => 'required|string|max:255',
            'Carrera' => 'required|string|max:50',
            'Grupo' => 'required|string|max:50',
            'Fecha_hora' => 'required',
            'Cantidad' => 'required|integer|min:1|max:100',
            'Descripcion' => 'required|string',
            'Estado' => 'nullable',
            'Fecha_devolucion' => 'nullable',
            'Material_Folio' => 'required|string', 
            'Detalle' => 'nullable|string|max:50', 
        ]);
        
        // Actualizar el préstamo con los nuevos valores
        $prestamo->update($request->all());
        // Establecer un mensaje de éxito en la sesión
        session()->flash('success', 'Préstamo modificado correctamente');
    
        // Redirigir a la ruta 'Prestamo.index'
        return redirect()->route('Prestamo.index');
    }

    // Método para marcar un préstamo como devuelto
    public function devolver(Request $request, Prestamo $prestamo)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'Estado' => 'required|string',
            'Detalle' => 'nullable|string',
            'Fecha_devolucion' => 'nullable',  // Asegúrate de validar como fecha si es opcional
        ]);
    
        // Asignar los nuevos valores de estado y detalle
        $estado = $request->input('Estado', 'Entregado');
        $detalle = $request->input('Detalle', 'Ninguno');
    
        // Actualizar el préstamo con los nuevos valores y la fecha de devolución
        $updated = $prestamo->update([
            'Estado' => $estado,
            'Detalle' => $detalle,
            'Fecha_devolucion' => now(),  // Actualizar con la fecha actual
        ]);
    
        if ($updated) {
            // Establecer un mensaje de éxito en la sesión
            session()->flash('success', 'Préstamo devuelto correctamente');
        } else {
            // Establecer un mensaje de error en la sesión si no se pudo devolver el préstamo
            session()->flash('error', 'No se pudo devolver el préstamo');
        }
    
        // Redirigir a la ruta 'Prestamo.index'
        return redirect()->route('Prestamo.index');
    }

    // Método para eliminar un préstamo
    public function destroy(Prestamo $prestamo)
    {
        // Eliminar el préstamo de la base de datos
        $prestamo->delete();
        // Redirigir a la ruta 'Prestamo.index'
        return redirect()->route('Prestamo.index');
    }
}
