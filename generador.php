<?php
// Mostrar errores detallados
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Función para recorrer carpetas y extraer docstrings
function processFolder($source, $target)
{
    echo "📂 Procesando carpeta: $source\n";

    // Verificar si la carpeta de origen existe
    if (!is_dir($source)) {
        echo "❌ Error: La carpeta de origen '$source' no existe.\n";
        return;
    }

    // Crear la carpeta de destino si no existe
    if (!file_exists($target)) {
        echo "📁 Creando directorio de destino: $target\n";
        if (!mkdir($target, 0777, true)) {
            echo "❌ Error: No se pudo crear la carpeta de destino: $target\n";
            return;
        }
    }

    // Obtener archivos PHP y CSS
    $phpFiles = glob($source . DIRECTORY_SEPARATOR . '*.php');
    $cssFiles = glob($source . DIRECTORY_SEPARATOR . '*.css');

    $files = array_merge($phpFiles, $cssFiles);

    // Procesar cada archivo encontrado
    foreach ($files as $file) {
        echo "🔍 Extrayendo docstring de: $file\n";
        $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);
        $fileFolderPath = $target . DIRECTORY_SEPARATOR . $fileNameWithoutExtension . '.txt';

        $docstringContent = extractDocstring($file);

        // Guardar el contenido del docstring en el archivo .txt
        if ($docstringContent !== '') {
            if (file_put_contents($fileFolderPath, $docstringContent) === false) {
                echo "❌ Error: No se pudo escribir en el archivo: $fileFolderPath\n";
            } else {
                echo "✅ Guardado en: $fileFolderPath\n";
            }
        } else {
            echo "⚠️ No se encontraron docstrings en: $file\n";
        }
    }

    // Procesar subcarpetas de manera recursiva
    $folders = glob($source . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
    foreach ($folders as $folder) {
        echo "📂 Procesando subcarpeta: $folder\n";
        $folderName = basename($folder);
        $newTarget = $target . DIRECTORY_SEPARATOR . $folderName;
        processFolder($folder, $newTarget);
    }
}

// Función para extraer docstrings de archivos PHP y CSS
function extractDocstring($filePath)
{
    echo "📄 Leyendo archivo: $filePath\n";

    if (!file_exists($filePath)) {
        echo "❌ Error: El archivo '$filePath' no existe.\n";
        return '';
    }

    $content = file_get_contents($filePath);
    if ($content === false) {
        echo "❌ Error: No se pudo leer el archivo '$filePath'.\n";
        return '';
    }

    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $docstrings = '';

    switch ($extension) {
        case 'php':
            // Buscar docstrings en PHP (comentarios de documentación /** ... */)
            if (preg_match_all('/\/\*\*([\s\S]*?)\*\//', $content, $matches)) {
                $docstrings = implode("\n\n", array_map('trim', $matches[1]));
            }
            break;

        case 'css':
            // Buscar comentarios en CSS (/* ... */)
            if (preg_match_all('/\/\*([\s\S]*?)\*\//', $content, $matches)) {
                $docstrings = implode("\n\n", array_map('trim', $matches[1]));
            }
            break;

        default:
            echo "⚠️ Tipo de archivo no compatible: $filePath\n";
    }

    return $docstrings;
}

// Definir carpetas de origen y destino
$sourceFolder = '/Applications/MAMP/htdocs/GitHub/darkorange'; // Carpeta del código fuente
$targetFolder = '/Applications/MAMP/htdocs/GitHub/Primero-de-DAM-Luis-Rodriguez/doc_darkorange/documentacion'; // Nueva carpeta de documentación

// Crear la carpeta de documentación si no existe
if (!file_exists($targetFolder)) {
    echo "📁 Creando carpeta de documentación en: $targetFolder\n";
    mkdir($targetFolder, 0777, true);
}

// Ejecutar el script
try {
    processFolder($sourceFolder, $targetFolder);
    echo "🎉 Procesamiento completado con éxito!\n";
} catch (Exception $e) {
    echo "❌ Error general: " . $e->getMessage() . "\n";
}
