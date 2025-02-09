# 📄 Proyecto de Documentación - Generador de Docstrings en PHP

## 📌 Descripción del Proyecto

Este script permite **generar y visualizar documentación automáticamente** a partir del código fuente de un proyecto PHP.  

Está diseñado para **extraer docstrings de los archivos PHP**, organizarlos en archivos `.txt` dentro de la carpeta `documentacion/` y mostrarlos en una **interfaz web navegable**.  

Actualmente, **documenta el proyecto DarkOrange**, pero está **pensado para funcionar con cualquier otro proyecto PHP** con docstrings estructurados.

---

## 🏗️ Estructura del Proyecto

📂 **documentacion/** → Carpeta donde se generan los archivos `.txt` con la documentación.  
  - 📂 `admin/` → Documentación de los archivos del panel de administración.  
  - 📂 `backend/` → Documentación de archivos del backend.  

📂 **includes/** → Archivos auxiliares de la interfaz.  
  - `functions.php` → Funciones para manejar la documentación.  
  - `navigation.php` → Control de navegación entre los archivos documentados.  

📜 **index.php** → Interfaz web para visualizar y navegar por la documentación generada.  
📜 **generador.php** → Script encargado de extraer los docstrings y generar los archivos `.txt`.  
📜 **scripts.js** → Código JavaScript para mejorar la interacción en la interfaz.  
📜 **style.css** → Estilos CSS personalizados para la visualización de la documentación.  

---

## 🔧 Tecnologías Utilizadas

✅ **Backend:** PHP puro (sin frameworks).  
✅ **Frontend:** HTML, CSS, JavaScript.  
✅ **Almacenamiento:** Archivos `.txt` en la carpeta `documentacion/`.  
✅ **Entorno:** Puede ejecutarse en un servidor local o remoto con soporte PHP.  

---

## ⚙️ Funcionamiento del Proyecto

1️⃣ **Extracción de Docstrings:**  
   - `generador.php` analiza los archivos PHP dentro del proyecto seleccionado.  
   - Busca **docstrings** en los comentarios de los archivos PHP (`/** ... */` y `// ...`).  

2️⃣ **Generación de Documentación:**  
   - Extrae los docstrings y los guarda como **archivos `.txt`** dentro de `documentacion/`.  
   - La estructura de `documentacion/` respeta la organización del proyecto original.  

3️⃣ **Interfaz Web (`index.php`)**  
   - Permite visualizar y navegar entre los archivos documentados de manera clara.  
   - Usa **HTML, CSS y JavaScript** para una mejor experiencia de usuario.  

---

## 📡 APIs y Automatización

Este script **automatiza la documentación** de cualquier proyecto PHP sin modificar su código original.  
Algunas características incluyen:  

- **Generación dinámica de archivos** → `generador.php` extrae docstrings y crea `.txt` organizados.  
- **Interfaz navegable** → `index.php` permite recorrer la documentación sin salir del navegador.  
- **Compatibilidad con cualquier proyecto PHP** → Solo necesitas modificar la ruta de los archivos a documentar.  

Ejemplo de un **docstring en PHP** reconocido por el script:  

```php
/**
 * Conecta a la base de datos MySQL.
 * 
 * @return mysqli Conexión activa a la base de datos.
 */
function conectarBD() {
    // Código de conexión...
}
```
## 🔗 Integración con DarkOrange y Otros Proyectos

Actualmente, este script **documenta el código de DarkOrange**, pero está diseñado para funcionar con **cualquier otro proyecto PHP** con docstrings.

- 🔹 **Documenta DarkOrange automáticamente** y permite visualizar la documentación desde un navegador.  
- 🔹 **Fácilmente adaptable a otros proyectos** cambiando la ruta de los archivos a analizar.  
- 🔹 **No modifica el código original**, solo extrae información de los docstrings.  

---

## 📜 Documentación del Proyecto

Si deseas ver la documentación completa del código, puedes:

- **Revisar el código fuente en el repositorio de scriptdocumentacion**, donde cada archivo está comentado para facilitar su comprensión.  

📌 **Repositorio del script:** [https://github.com/luisrocedev/scriptdocumentacion](https://github.com/luisrocedev/scriptdocumentacion)  

---

## 👨‍💻 Contacto

Si tienes preguntas o sugerencias, ¡contáctame en **LinkedIn** o revisa mi **GitHub**! 🚀
