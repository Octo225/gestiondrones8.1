<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Préstamo</title>
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
        }
        
        th {
            font-weight: bold;
            color: #333;
        }
        
        td {
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="{{ public_path() . '/imagen/logo_cona.jpg' }}" alt="Logo">
            <h1>Detalles del Préstamo</h1>
        </div>
        
        <!-- Mostrar los detalles del préstamo en una tabla -->
        <table>
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $prestamo->id }}</td>
                </tr>
                <tr>
                    <th>Nombre del Alumno</th>
                    <td>{{ $prestamo->Nombre_alumno }}</td>
                </tr>
                <tr>
                    <th>Fecha y Hora</th>
                    <td>{{ $prestamo->Fecha_hora }}</td>
                </tr>
                <tr>
                    <th>Fecha Devolución</th>
                    <td>{{ $prestamo->Fecha_devolucion }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $prestamo->Estado }}</td>
                </tr>
                <tr>
                    <th>Defecto</th>
                    <td>{{ $prestamo->Detalle }}</td>
                </tr>
                <tr>
                    <th>Material</th>
                    <td>{{ $prestamo->Material_Folio }}</td>
                </tr>
                <tr>
                    <th>Carrera</th>
                    <td>{{ $prestamo->Carrera }}</td>
                </tr>
                <tr>
                    <th>Grupo</th>
                    <td>{{ $prestamo->Grupo }}</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>{{ $prestamo->Cantidad }}</td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td>{{ $prestamo->Descripcion }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
