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
    $html = "";
    $items = scandir($baseDir);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $sourcePath = $baseDir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($sourcePath)) {
            // Añadir un span con la clase 'folder-icon' para mostrar el icono 🔼/🔽
            $html .= "<li><div class='folder' onclick='toggleFolder(event)'>
                        <span class='folder-icon'>🔽</span> $item
                      </div>";
            $html .= "<ul class='nested'>";
            $html .= generateNavigation($sourcePath);
            $html .= "</ul></li>";
        } else if (is_file($sourcePath) && pathinfo($item, PATHINFO_EXTENSION) === 'txt') {
            // Generar enlaces a los archivos de documentación
            $fileNameWithoutExtension = pathinfo($item, PATHINFO_FILENAME);
            $publicPath = str_replace(DIRECTORY_SEPARATOR, '/', $sourcePath);
            $html .= "<li><a href='#' onclick=\"loadFile('$publicPath'); return false;\">$fileNameWithoutExtension</a></li>";
        }
    }

    return $html;
}
