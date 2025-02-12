<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación</title>
    <link rel="stylesheet" href="style.css"> <!-- Enlace al archivo de estilos -->
    <script src="scripts.js"></script> <!-- Enlace al archivo de scripts -->
</head>

<body>
    <!-- Barra lateral con el índice -->
    <div class="sidebar">
        <h1>Documentación</h1> <!-- Título principal -->
        <h2>Índice</h2> <!-- Subtítulo -->

        <ul class="toc"> <!-- Lista de archivos de documentación -->
            <?php
            $baseDir = 'documentacion';         // Ajustado para que coincida con el script
            // Verificar si el archivo de navegación existe antes de incluirlo
            if (file_exists('includes/navigation.php')) {
                require_once 'includes/navigation.php';

                // Verificar si la función está definida
                if (function_exists('generateNavigation')) {
                    echo generateNavigation($baseDir);
                } else {
                    echo "<p>Error: La función 'generateNavigation' no está definida.</p>";
                }
            } else {
                echo "<p>Error: No se encontró el archivo de navegación.</p>";
            }
            ?>
        </ul>
    </div>

    <!-- Sección de contenido principal -->
    <div class="content" id="content">
        <h2>Selecciona un archivo para visualizar</h2>
        <p>El contenido del archivo aparecerá aquí.</p>
    </div>
</body>

</html>