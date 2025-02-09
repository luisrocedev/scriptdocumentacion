<?php
// includes/functions.php

/**
 * Procesa una carpeta y genera archivos .txt con los docstrings de los archivos PHP y CSS.
 */
function processFolder($source, $target)
{
    // Asegurarse de que la carpeta de destino exista
    if (!file_exists($target)) {
        mkdir($target, 0777, true);
    }

    // Obtener archivos PHP y CSS directamente
    $files = array_merge(
        glob($source . DIRECTORY_SEPARATOR . '*.php'),
        glob($source . DIRECTORY_SEPARATOR . '*.css')
    );

    foreach ($files as $file) {
        $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);
        $fileFolderPath = $target . DIRECTORY_SEPARATOR . $fileNameWithoutExtension . '.txt';

        $docstringContent = extractDocstring($file);

        // Guardar el contenido del docstring en el archivo .txt
        file_put_contents($fileFolderPath, $docstringContent);
    }

    // Procesar subcarpetas recursivamente
    $folders = glob($source . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
    foreach ($folders as $folder) {
        $folderName = basename($folder);
        $newTarget = $target . DIRECTORY_SEPARATOR . $folderName;
        processFolder($folder, $newTarget);
    }
}

/**
 * Extrae el docstring de un archivo PHP o CSS.
 */
function extractDocstring($filePath)
{
    $content = file_get_contents($filePath);
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

    switch ($extension) {
        case 'php':
            // Buscar docstrings que comienzan con /** (comentarios de documentación)
            if (preg_match_all('/\/\*\*([\s\S]*?)\*\//', $content, $matches)) {
                return implode("\n\n", array_map('trim', $matches[1])); // Unir múltiples docstrings
            }
            break;

        case 'css':
            // Buscar comentarios que comienzan con /* (incluyendo docstrings)
            if (preg_match_all('/\/\*([\s\S]*?)\*\//', $content, $matches)) {
                return implode("\n\n", array_map('trim', $matches[1])); // Unir múltiples comentarios
            }
            break;

        default:
            return '';
    }

    return '';
}
