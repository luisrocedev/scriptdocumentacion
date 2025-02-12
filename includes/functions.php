<?php
// ===============================================
// INCLUDES/FUNCTIONS.PHP - FUNCIONES AUXILIARES
// ===============================================

/**
 * Procesa una carpeta y genera archivos .txt con los docstrings de los archivos PHP y CSS.
 * 
 * Se encarga de recorrer los archivos dentro de una carpeta de origen,
 * extraer la documentación en formato docstring y guardarla en archivos .txt
 * en una carpeta de destino. Además, procesa subcarpetas de manera recursiva.
 */
function processFolder($source, $target)
{
    // ====================================================
    // VERIFICACIÓN Y CREACIÓN DE CARPETA DESTINO
    // ====================================================

    // Si la carpeta de destino no existe, la crea con permisos 0777
    if (!file_exists($target)) {
        mkdir($target, 0777, true);
    }

    // ====================================================
    // OBTENCIÓN DE ARCHIVOS PHP Y CSS
    // ====================================================

    // Busca archivos PHP y CSS en la carpeta origen
    $files = array_merge(
        glob($source . DIRECTORY_SEPARATOR . '*.php'), // Encuentra archivos PHP
        glob($source . DIRECTORY_SEPARATOR . '*.css')  // Encuentra archivos CSS
    );

    // ====================================================
    // PROCESAMIENTO DE CADA ARCHIVO
    // ====================================================

    foreach ($files as $file) {
        $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME); // Obtiene el nombre del archivo sin extensión
        $fileFolderPath = $target . DIRECTORY_SEPARATOR . $fileNameWithoutExtension . '.txt'; // Define la ruta de salida

        $docstringContent = extractDocstring($file); // Extrae los docstrings del archivo

        // Guarda el contenido del docstring en un archivo .txt dentro de la carpeta destino
        file_put_contents($fileFolderPath, $docstringContent);
    }

    // ====================================================
    // PROCESAMIENTO RECURSIVO DE SUBCARPETAS
    // ====================================================

    // Busca todas las subcarpetas dentro del directorio actual
    $folders = glob($source . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);

    foreach ($folders as $folder) {
        $folderName = basename($folder); // Obtiene el nombre de la carpeta
        $newTarget = $target . DIRECTORY_SEPARATOR . $folderName; // Define la nueva carpeta de destino

        processFolder($folder, $newTarget); // Llamada recursiva para procesar la subcarpeta
    }
}

/**
 * Extrae los docstrings de un archivo PHP o CSS.
 * 
 * Analiza el contenido del archivo y extrae los comentarios de documentación.
 * En PHP, busca docstrings que comienzan con `/**` y en CSS busca comentarios `/*`.
 */
function extractDocstring($filePath)
{
    $content = file_get_contents($filePath); // Lee el contenido del archivo
    $extension = pathinfo($filePath, PATHINFO_EXTENSION); // Obtiene la extensión del archivo

    // ====================================================
    // EXTRACCIÓN DE DOCSTRINGS SEGÚN EL TIPO DE ARCHIVO
    // ====================================================

    switch ($extension) {
        case 'php':
            // Busca comentarios de documentación en PHP (/** ... */)
            if (preg_match_all('/\/\*\*([\s\S]*?)\*\//', $content, $matches)) {
                return implode("\n\n", array_map('trim', $matches[1])); // Une múltiples docstrings encontrados
            }
            break;

        case 'css':
            // Busca comentarios en CSS (/* ... */)
            if (preg_match_all('/\/\*([\s\S]*?)\*\//', $content, $matches)) {
                return implode("\n\n", array_map('trim', $matches[1])); // Une múltiples comentarios encontrados
            }
            break;

        default:
            return ''; // Si no es PHP ni CSS, retorna una cadena vacía
    }

    return ''; // Retorna vacío si no se encontraron docstrings
}
