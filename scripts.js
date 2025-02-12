// =============================================
// FUNCIÓN PARA EXPANDIR O CONTRAER CARPETAS
// =============================================

/**
 * Maneja la expansión o contracción de carpetas en el índice de navegación.
 * Al hacer clic en una carpeta, alterna su estado (abierto o cerrado).
 */
function toggleFolder(event) {
    const folder = event.currentTarget; // Obtiene el elemento que disparó el evento
    const nestedList = folder.nextElementSibling; // Obtiene la lista anidada de la carpeta

    if (nestedList.classList.contains('open')) {
        nestedList.classList.remove('open'); // Contrae la carpeta si ya está abierta
    } else {
        nestedList.classList.add('open'); // Expande la carpeta si está cerrada
    }
}

// =============================================
// FUNCIÓN PARA CARGAR EL CONTENIDO DE UN ARCHIVO CON AJAX
// =============================================

/**
 * Carga el contenido de un archivo mediante AJAX y lo muestra en la página.
 * 
 * @param {string} filePath - Ruta del archivo a cargar.
 */
function loadFile(filePath) {
    const contentDiv = document.getElementById('content'); // Obtiene el contenedor donde se mostrará el contenido

    // Muestra un mensaje de carga mientras se obtiene el archivo
    contentDiv.innerHTML = '<p class="loading">Cargando contenido...</p>';

    // Realiza la petición AJAX usando Fetch API
    fetch(filePath)
        .then(response => {
            // Verifica si la respuesta es válida (código HTTP 200-299)
            if (!response.ok) throw new Error(`Error al cargar el archivo: ${response.status}`);
            return response.text(); // Convierte la respuesta en texto
        })
        .then(data => {
            // Muestra el contenido del archivo dentro de un elemento <pre> para mantener el formato
            contentDiv.innerHTML = `<pre>${data}</pre>`;
        })
        .catch(error => {
            // Muestra un mensaje de error si la carga falla
            contentDiv.innerHTML = `<p class="error">Error al cargar el archivo: ${error.message}</p>`;
        });
}
