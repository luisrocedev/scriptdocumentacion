// Función para manejar la expansión/contracción de carpetas
function toggleFolder(event) {
    const folder = event.currentTarget;
    const nestedList = folder.nextElementSibling;

    if (nestedList.classList.contains('open')) {
        nestedList.classList.remove('open'); // Contraer
    } else {
        nestedList.classList.add('open'); // Expandir
    }
}

// Función para cargar el contenido del archivo con AJAX
function loadFile(filePath) {
    const contentDiv = document.getElementById('content');
    contentDiv.innerHTML = '<p class="loading">Cargando contenido...</p>';

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