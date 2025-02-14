<?php
// --------------------------------------------
// CONFIGURACIÓN DE ERRORES
// --------------------------------------------

// Habilita la visualización de errores en la pantalla (útil para depuración)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --------------------------------------------
// FUNCIÓN PRINCIPAL PARA PROCESAR CARPETAS
// --------------------------------------------

/**
 * Recorre una carpeta, extrae los docstrings de archivos PHP y CSS,
 * y guarda la documentación en archivos de texto en la carpeta destino.
 */
function processFolder($source, $target)
{
    echo "📂 Procesando carpeta: $source\n";

    // Verificar si la carpeta de origen existe antes de continuar
    if (!is_dir($source)) {
        echo "❌ Error: La carpeta de origen '$source' no existe.\n";
        return; // Termina la ejecución de la función si la carpeta no existe
    }

    // Crear la carpeta de destino si no existe
    if (!file_exists($target)) {
        echo "📁 Creando directorio de destino: $target\n";
        if (!mkdir($target, 0777, true)) { // Se crean todas las carpetas necesarias
            echo "❌ Error: No se pudo crear la carpeta de destino: $target\n";
            return; // Detiene la función si no se puede crear la carpeta
        }
    }

    // --------------------------------------------
    // OBTENCIÓN DE ARCHIVOS PHP Y CSS
    // --------------------------------------------

    // Buscar archivos PHP en la carpeta actual
    $phpFiles = glob($source . DIRECTORY_SEPARATOR . '*.php');

    // Buscar archivos CSS en la carpeta actual
    $cssFiles = glob($source . DIRECTORY_SEPARATOR . '*.css');

    // Unir ambos conjuntos de archivos en un solo array
    $files = array_merge($phpFiles, $cssFiles);

    // --------------------------------------------
    // PROCESAMIENTO DE CADA ARCHIVO
    // --------------------------------------------

    foreach ($files as $file) {
        echo "🔍 Extrayendo docstring de: $file\n";

        // Obtener el nombre del archivo sin la extensión
        $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);

        // Crear la ruta donde se guardará la documentación extraída
        $fileFolderPath = $target . DIRECTORY_SEPARATOR . $fileNameWithoutExtension . '.txt';

        // Extraer los docstrings del archivo
        $docstringContent = extractDocstring($file);

        // Si se encontraron docstrings, guardarlos en un archivo de texto
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

    // --------------------------------------------
    // PROCESAMIENTO DE SUBCARPETAS (RECURSIÓN)
    // --------------------------------------------

    // Obtener todas las subcarpetas dentro del directorio actual
    $folders = glob($source . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);

    // Recorrer cada subcarpeta y procesarla de manera recursiva
    foreach ($folders as $folder) {
        echo "📂 Procesando subcarpeta: $folder\n";

        // Obtener el nombre de la subcarpeta
        $folderName = basename($folder);

        // Crear la ruta de destino para la subcarpeta
        $newTarget = $target . DIRECTORY_SEPARATOR . $folderName;

        // Llamada recursiva para procesar la subcarpeta
        processFolder($folder, $newTarget);
    }
}

// --------------------------------------------
// FUNCIÓN PARA EXTRAER DOCSTRINGS
// --------------------------------------------

/**
 * Extrae los docstrings de archivos PHP y CSS.
 * Solo se extraen comentarios en formato /** ... * / en PHP y /* ... * / en CSS.
 */
function extractDocstring($filePath)
{
    echo "📄 Leyendo archivo: $filePath\n";

    // Verificar si el archivo existe antes de procesarlo
    if (!file_exists($filePath)) {
        echo "❌ Error: El archivo '$filePath' no existe.\n";
        return ''; // Devuelve una cadena vacía si el archivo no existe
    }

    // Leer el contenido del archivo
    $content = file_get_contents($filePath);

    if ($content === false) {
        echo "❌ Error: No se pudo leer el archivo '$filePath'.\n";
        return ''; // Devuelve una cadena vacía si hubo un error al leer el archivo
    }

    // Obtener la extensión del archivo (.php o .css)
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $docstrings = '';

    // --------------------------------------------
    // EXTRACCIÓN DE DOCSTRINGS SEGÚN TIPO DE ARCHIVO
    // --------------------------------------------

    switch ($extension) {
        case 'php':
            // Buscar comentarios de documentación en PHP (/** ... */)
            if (preg_match_all('/\/\*\*([\s\S]*?)\*\//', $content, $matches)) {
                // Unir todos los docstrings encontrados
                $docstrings = implode("\n\n", array_map('trim', $matches[1]));
            }
            break;

        case 'css':
            // Buscar comentarios en CSS (/* ... */)
            if (preg_match_all('/\/\*([\s\S]*?)\*\//', $content, $matches)) {
                // Unir todos los comentarios encontrados
                $docstrings = implode("\n\n", array_map('trim', $matches[1]));
            }
            break;

        default:
            echo "⚠️ Tipo de archivo no compatible: $filePath\n";
    }

    return $docstrings; // Devuelve los docstrings encontrados
}

// --------------------------------------------
// CONFIGURACIÓN DE LAS CARPETAS
// --------------------------------------------

// Ruta de la carpeta donde se encuentra el código fuente
$sourceFolder = '/Applications/MAMP/htdocs/GitHub/darkorange';

// Ruta de la carpeta donde se guardará la documentación generada
$targetFolder = '/Applications/MAMP/htdocs/GitHub/scriptdocumentacion/documentacion';

// --------------------------------------------
// CREACIÓN DE LA CARPETA DE DOCUMENTACIÓN SI NO EXISTE
// --------------------------------------------

if (!file_exists($targetFolder)) {
    echo "📁 Creando carpeta de documentación en: $targetFolder\n";
    mkdir($targetFolder, 0777, true); // Crea la carpeta con permisos adecuados
}

// --------------------------------------------
// EJECUCIÓN DEL SCRIPT
// --------------------------------------------

try {
    // Iniciar el procesamiento de la carpeta de código fuente
    processFolder($sourceFolder, $targetFolder);
    echo "🎉 Procesamiento completado con éxito!\n";
} catch (Exception $e) {
    echo "❌ Error general: " . $e->getMessage() . "\n"; // Captura cualquier error inesperado
}
