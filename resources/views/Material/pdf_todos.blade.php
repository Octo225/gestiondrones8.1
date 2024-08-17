<!DOCTYPE html>
<html>
<head>
    <title>Todos los Materiales</title>
    <style>
        /* Estilos generales para la página */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        
        /* Estilos para el contenedor principal */
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Contenedor flex para alinear el logo y el título */
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        /* Estilo para el logo */
        .header img {
            height: 40px;
            margin-right: 10px;
        }
        
        /* Estilo para el título */
        .header h1 {
            color: #333;
            font-size: 20px;
            margin: 0;
        }
        
        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        td {
            background-color: #ffffff;
            font-size: 12px;
            color: #555;
        }
        
        th {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="{{ public_path() . '/imagen/logo_cona.jpg' }}" alt="Logo">
            <h1>Lista de Todos los Materiales</h1>
        </div>
        
        <!-- Tabla que muestra la lista de materiales -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Folio</th>
                </tr>
            </thead>
            <tbody>
                <!-- Iterar sobre la colección de Materiales y mostrar cada uno en una fila de la tabla -->
                @forelse ($materiales as $material)
                    <tr>
                        <td>{{ $material->id }}</td>
                        <td>{{ $material->nombre }}</td>
                        <td>{{ $material->descripcion }}</td>
                        <td>{{ $material->Folio_Conalep }}</td>
                    </tr>
                <!-- Mostrar un mensaje si no hay Materiales disponibles -->
                @empty
                    <tr>
                        <td colspan="4">No hay Materiales disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
