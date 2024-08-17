<!DOCTYPE html>
<html>
<head>
    <title>Todos los Préstamos</title>
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
            max-width: 1000px;
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
            table-layout: fixed; /* Asegura que la tabla no se desborde */
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            word-wrap: break-word; /* Asegura que el contenido largo se ajuste */
        }
        
        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f1f1f1;
        }
        
        /* Estilos para el mensaje de no datos */
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path() . '/imagen/logo_cona.jpg' }}" alt="Logo">
            <h1>Lista de Todos los Préstamos</h1>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Alumno</th>
                    <th>Carrera</th>
                    <th>Grupo</th>
                    <th>Fecha y Hora</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha Devolución</th>
                    <th>Material Folio</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                <!-- Iterar sobre la colección de préstamos y mostrar cada uno en una fila de la tabla -->
                @forelse ($prestamos as $prestamo)
                    <tr>
                        <td>{{ $prestamo->id }}</td>
                        <td>{{ $prestamo->Nombre_alumno }}</td>
                        <td>{{ $prestamo->Carrera }}</td>
                        <td>{{ $prestamo->Grupo }}</td>
                        <td>{{ $prestamo->Fecha_hora }}</td>
                        <td>{{ $prestamo->Cantidad }}</td>
                        <td>{{ $prestamo->Descripcion }}</td>
                        <td>{{ $prestamo->Estado }}</td>
                        <td>{{ $prestamo->Fecha_devolucion }}</td>
                        <td>{{ $prestamo->Material_Folio }}</td>
                        <td>{{ $prestamo->Detalle }}</td>
                    </tr>
                <!-- Mostrar un mensaje si no hay préstamos disponibles -->
                @empty
                    <tr>
                        <td colspan="11" class="no-data">No hay préstamos disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
