<?php
// ===============================================
// INCLUDES/NAVIGATION.PHP - GENERADOR DE ÍNDICE
// ===============================================

/**
 * Genera el HTML para el índice de documentación.
 * 
 * Recorre la estructura de archivos en la carpeta base y genera
 * una lista con enlaces a los archivos de documentación en formato .txt.
 * También detecta subcarpetas y permite expandirlas dinámicamente.
 */
function generateNavigation($baseDir)
{
    $html = ""; // Inicializa la variable donde se almacenará el HTML del índice
    $items = scandir($baseDir); // Obtiene todos los elementos dentro de la carpeta base

    // ====================================================
    // RECORRIDO DE ELEMENTOS EN LA CARPETA
    // ====================================================

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue; // Ignora los directorios especiales "." y ".."
        }

        $sourcePath = $baseDir . DIRECTORY_SEPARATOR . $item; // Construye la ruta completa del elemento

        // ====================================================
        // MANEJO DE CARPETAS
        // ====================================================

        if (is_dir($sourcePath)) {
            // Si es una carpeta, crea un elemento <li> con la opción de expandir/cerrar
            $html .= "<li><div class='folder' onclick='toggleFolder(event)'>$item</div>";
            $html .= "<ul class='nested'>"; // Lista anidada para los archivos dentro de la carpeta
            $html .= generateNavigation($sourcePath); // Llamada recursiva para procesar la subcarpeta
            $html .= "</ul></li>"; // Cierra la lista anidada
        }

        // ====================================================
        // MANEJO DE ARCHIVOS
        // ====================================================

        else if (is_file($sourcePath) && pathinfo($item, PATHINFO_EXTENSION) === 'txt') {
            // Si es un archivo de documentación (.txt), crea un enlace en el índice

            $fileNameWithoutExtension = pathinfo($item, PATHINFO_FILENAME); // Obtiene el nombre del archivo sin extensión
            $publicPath = str_replace(DIRECTORY_SEPARATOR, '/', $sourcePath); // Convierte rutas para compatibilidad web

            // Crea un enlace que carga el archivo en la sección de contenido usando AJAX
            $html .= "<li><a href='#' onclick=\"loadFile('$publicPath'); return false;\">$fileNameWithoutExtension</a></li>";
        }
    }

    return $html; // Devuelve el HTML generado
}
