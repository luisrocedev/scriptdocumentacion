<?php
// includes/navigation.php

/**
 * Genera el HTML para el índice de documentación.
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
            // Carpeta
            $html .= "<li><div class='folder' onclick='toggleFolder(event)'>$item</div>";
            $html .= "<ul class='nested'>";
            $html .= generateNavigation($sourcePath);
            $html .= "</ul></li>";
        } else if (is_file($sourcePath) && pathinfo($item, PATHINFO_EXTENSION) === 'txt') {
            // Archivo
            $fileNameWithoutExtension = pathinfo($item, PATHINFO_FILENAME);
            $publicPath = str_replace(DIRECTORY_SEPARATOR, '/', $sourcePath); // Convierte rutas a formato web
            $html .= "<li><a href='#' onclick=\"loadFile('$publicPath'); return false;\">$fileNameWithoutExtension</a></li>";
        }
    }
    return $html;
}
