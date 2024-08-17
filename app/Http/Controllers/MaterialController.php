<?php

namespace App\Http\Controllers;

// Se incluyen los modelos y clases necesarias
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

// Definición del controlador MaterialController que extiende de Controller
class MaterialController extends Controller
{
    // Constructor del controlador
    public function __construct()
    {
        // Aplicar middleware 'auth' a todas las rutas
        $this->middleware('auth');
    }

    public function generarPdfTodos()
    {
        $materiales = Material::all();
        $pdf = PDF::loadView('Material.pdf_todos', compact('materiales'));
        return $pdf->download('todos_los_materiales.pdf');
    }

    // Método para mostrar todos los materiales
    public function index()
    {
        // Obtener todos los registros de la tabla 'materials'
        $materials = Material::all();
        // Retornar la vista 'Material.index' con los materiales obtenidos
        return view('Material.index', compact('materials'));
    }

    // Método para mostrar el formulario de creación de material
    public function create()
    {
        // Retornar la vista 'Material.create'
        return view('Material.create');
    }

    // Método para almacenar un nuevo material
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'id' => 'required|string|max:50',
            'Folio_Conalep' => 'required|string|max:20',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg|max:10240',
        ], [
            // Mensajes de error personalizados
            'id.required' => 'El número de serie es obligatorio.',
            'Folio_Conalep.required' => 'El folio es obligatorio.',
            'nombre.required' => 'El nombre es obligatorio.',
            'descripcion.required' => 'La descripcion es obligatoria.',
            'imagen.mimes' => 'La imagen debe ser un archivo de tipo: jpg.',
        ]);
    
        try {
            // Crear una nueva instancia del modelo Material
            $material = new Material();
            // Asignar los valores de los campos del formulario al objeto Material
            $material->id = $request->input('id');
            $material->Folio_Conalep = $request->input('Folio_Conalep');
            $material->nombre = $request->input('nombre');
            $material->descripcion = $request->input('descripcion');
    
            // Si se subió una imagen, procesarla y codificarla en Base64
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $imageContent = file_get_contents($file->getRealPath()); // Obtener el contenido de la imagen
                $imageBase64 = base64_encode($imageContent); // Codificar el contenido en Base64
                $material->imagen = $imageBase64; // Guardar la cadena Base64 en la base de datos
            }
    
            // Guardar el material en la base de datos
            $material->save();
    
            // Establecer un mensaje de éxito en la sesión
            session()->flash('success', 'Material creado correctamente');
        } catch (\Exception $e) {
            // Establecer un mensaje de error en la sesión si ocurre una excepción
            session()->flash('error', 'No se pudo crear el material: ' . $e->getMessage());
        }
    
        // Redirigir a la ruta 'Material.index'
        return redirect()->route('Material.index');
    }
    

    // Método para mostrar el formulario de edición de material
    public function edit(Material $material)
    {
        // Retornar la vista 'Material.edit' con el material especificado
        return view('Material.edit', compact('material'));
    }

    // Método para actualizar un material existente
    public function update(Request $request, Material $material)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'id' => 'required|string|max:50',
            'Folio_Conalep' => 'required|string|max:20',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg|max:10240',
        ], [
            // Mensajes de error personalizados
            'id.required' => 'El número de serie es obligatorio.',
            'Folio_Conalep.required' => 'El folio es obligatorio.',
            'nombre.required' => 'El nombre es obligatorio.',
            'descripcion.required' => 'La descripcion es obligatoria.',
            'imagen.mimes' => 'La imagen debe ser un archivo de tipo: jpg.',
        ]);

        try {
            // Buscar el material por su id
            $material = Material::findOrFail($request->input('id'));
            // Asignar los nuevos valores a los campos del objeto Material
            $material->Folio_Conalep = $request->input('Folio_Conalep');
            $material->nombre = $request->input('nombre');
            $material->descripcion = $request->input('descripcion');

            // Si se subió una nueva imagen, procesarla y guardarla
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagen'), $imageName);
                $material->imagen = $imageName;
            }

            // Guardar los cambios en la base de datos
            $material->save();

            // Establecer un mensaje de éxito en la sesión
            session()->flash('success', 'Material modificado correctamente');
        } catch (\Exception $e) {
            // Establecer un mensaje de error en la sesión si ocurre una excepción
            session()->flash('error', 'No se pudo modificar el material: ' . $e->getMessage());
        }

        // Redirigir a la ruta 'Material.index'
        return redirect()->route('Material.index');
    }

    // Método para eliminar un material
    public function destroy(Material $material)
    {
        // Eliminar el material de la base de datos
        $material->delete();
        // Establecer un mensaje de éxito en la sesión
        session()->flash('success', 'Material eliminado correctamente');
        // Redirigir a la ruta 'Material.index'
        return redirect()->route('Material.index');
    }

    // Método para eliminar la imagen asociada a un material
    public function removeImage($material)
    {
        // Buscar el material por su id
        $material = Material::findOrFail($material);
        
        // Si el material tiene una imagen, eliminarla del sistema de archivos
        if ($material->imagen) {
            $imagePath = public_path('imagen') . '/' . $material->imagen;
            if (file_exists($imagePath)) {
                try {
                    unlink($imagePath); 
                } catch (\Exception $e) {
                    session()->flash('error', 'No se pudo eliminar la imagen: ' . $e->getMessage());
                    return redirect()->route('Material.edit', $material->id);
                }
            }
            
            // Establecer el campo imagen a null y guardar los cambios
            $material->imagen = null;
            $material->save();
        }

        // Establecer un mensaje de éxito en la sesión
        session()->flash('success', 'Imagen eliminada correctamente');
        // Redirigir a la ruta de edición del material
        return redirect()->route('Material.edit', $material->id);
    }
}
