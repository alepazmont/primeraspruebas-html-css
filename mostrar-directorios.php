<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Directorios y Archivos</title>
    <style>
        ul { list-style-type: none; }
        li { margin-bottom: 5px; }
    </style>
</head>
<body>

<h1>Contenido de la Carpeta</h1>

<?php
function listarContenido($directorio) {
    $contenido = [];
    $archivos = glob($directorio . '*');

    foreach ($archivos as $archivo) {
        if (is_dir($archivo)) {
            $contenido[] = [
                'tipo' => 'directorio',
                'nombre' => basename($archivo),
                'contenido' => listarContenido($archivo . '/')
            ];
        } else {
            $contenido[] = [
                'tipo' => 'archivo',
                'nombre' => basename($archivo)
            ];
        }
    }

    return $contenido;
}

$directorio = './'; // Ruta de la carpeta en tu servidor (puede necesitar ajustes)
$contenido = listarContenido($directorio);

function imprimirContenido($contenido) {
    echo '<ul>';
    foreach ($contenido as $elemento) {
        echo '<li>';
        if ($elemento['tipo'] === 'directorio') {
            echo '<strong>' . $elemento['nombre'] . '/</strong>';
            imprimirContenido($elemento['contenido']);
        } else {
            echo $elemento['nombre'];
        }
        echo '</li>';
    }
    echo '</ul>';
}

if (!empty($contenido)) {
    imprimirContenido($contenido);
} else {
    echo '<p>No hay contenido en la carpeta.</p>';
}
?>

</body>
</html>