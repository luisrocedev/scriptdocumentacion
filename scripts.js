// =============================================
// FUNCIÓN PARA EXPANDIR O CONTRAER CARPETAS
// =============================================

/**
 * Maneja la expansión o contracción de carpetas en el índice de navegación.
 * Cambia el icono 🔽 (cerrado) y 🔼 (abierto) dinámicamente.
 */
function toggleFolder(event) {
    const folder = event.currentTarget; // Elemento clicado
    const nestedList = folder.nextElementSibling; // Lista de archivos dentro de la carpeta
    const icon = folder.querySelector('.folder-icon'); // Icono 🔼/🔽 dentro de la carpeta

    if (nestedList.classList.contains('open')) {
        nestedList.classList.remove('open'); // Contraer carpeta
        icon.textContent = '🔽'; // Cambiar icono a cerrado
    } else {
        nestedList.classList.add('open'); // Expandir carpeta
        icon.textContent = '🔼'; // Cambiar icono a abierto
    }
}


// =============================================
// FUNCIÓN PARA CARGAR EL CONTENIDO DE UN ARCHIVO CON AJAX (LAZY LOADING)
// =============================================

/**
 * Carga el contenido de un archivo mediante AJAX y lo muestra en la página.
 */
function loadFile(filePath) {
    const contentDiv = document.getElementById('content');
    
    // Si el contenido ya está cargado, evitar recarga innecesaria
    if (contentDiv.getAttribute('data-loaded') === filePath) return;
    
    contentDiv.innerHTML = '<p class="loading">Cargando contenido...</p>';
    contentDiv.setAttribute('data-loaded', filePath); // Guardar el archivo cargado

    fetch(filePath)
        .then(response => {
            if (!response.ok) throw new Error(`Error al cargar el archivo: ${response.status}`);
            return response.text();
        })
        .then(data => {
            contentDiv.innerHTML = `<pre>${data}</pre>`;
        })
        .catch(error => {
            contentDiv.innerHTML = `<p class="error">Error al cargar el archivo: ${error.message}</p>`;
        });
}

// =============================================
// FUNCIÓN PARA ACTIVAR/DESACTIVAR MODO OSCURO
// =============================================

document.getElementById('toggleTheme').addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
});

// =============================================
// FUNCIÓN PARA FILTRAR ARCHIVOS EN EL ÍNDICE
// =============================================

document.getElementById('searchDocs').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let items = document.querySelectorAll('.toc li');

    items.forEach(item => {
        let text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
    });
});
