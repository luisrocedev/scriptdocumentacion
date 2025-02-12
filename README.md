# 📖 Generador de Documentación desde Docstrings

Este script permite extraer automáticamente los **docstrings** de archivos **PHP y CSS** dentro de una carpeta de un proyecto y genera archivos `.txt` con la documentación correspondiente.

> 🛑 **IMPORTANTE**: El script **solo funciona** si el código PHP y CSS está correctamente documentado con **docstrings** en los formatos adecuados (`/** ... */` en PHP y `/* ... */` en CSS).

---

## 🚀 **Cómo Usarlo**
### **1️⃣ Configurar la ruta del proyecto**
Para que el script funcione en tu proyecto, **solo debes cambiar la ruta de la carpeta donde se encuentra tu código**.

📌 **Abre el archivo `generador.php` y busca esta línea:**
```php
$sourceFolder = '/ruta/a/tu/proyecto';
```
🔹 **Ejemplo:** Si tu código está en la carpeta `mi_proyecto`, cambia la línea a:
```php
$sourceFolder = '/var/www/mi_proyecto';
```

📌 **También debes definir la carpeta donde se guardará la documentación:**
```php
$targetFolder = '/ruta/donde/se/guardara/la/documentacion';
```
🔹 **Ejemplo:** 
```php
$targetFolder = '/var/www/documentacion';
```

---

## 🛠 **Cómo Ejecutarlo**
Una vez configuradas las rutas, simplemente ejecuta el script desde la terminal o en tu navegador en **localhost**:

### **Desde la terminal:**
```sh
php generador.php
```
### **Desde el navegador (localhost):**
Abre `generador.php` en tu navegador.

El script recorrerá todos los archivos **PHP y CSS** en la carpeta del proyecto y generará archivos `.txt` con la documentación extraída.

---

## 📌 **Formato de Docstrings Soportado**
El script **extrae docstrings** solo si están en el formato correcto:

✅ **PHP (Docstrings en formato `/** ... */`)**
```php
/**
 * Esta función suma dos números y devuelve el resultado.
 */
function sumar($a, $b) {
    return $a + $b;
}
```

✅ **CSS (Comentarios en formato `/* ... */`)**
```css
/* Estilo del botón principal */
.button {
    background-color: blue;
    color: white;
}
```

---

## 📂 **Salida del Script**
Cada archivo documentado generará un `.txt` en la carpeta de documentación.

🔹 **Ejemplo de estructura generada:**
```
documentacion/
│── mi_archivo.php.txt
│── estilos.css.txt
│── subcarpeta/
│   ├── otro_archivo.php.txt
│   └── mas_estilos.css.txt
```
Cada `.txt` contendrá **únicamente los docstrings extraídos** del archivo correspondiente.

---

## 🔥 **Beneficios**
✅ Automatiza la generación de documentación sin esfuerzo.  
✅ Compatible con cualquier proyecto PHP y CSS documentado correctamente.  
✅ Organiza la documentación en una estructura clara.  
✅ Facilita la revisión de código y mantenimiento del proyecto.  

---

## 🎯 **¿Tienes Problemas?**
Si el script **no genera documentación**, revisa lo siguiente:

1️⃣ **Asegúrate de que los archivos PHP y CSS contienen docstrings** en los formatos soportados.  
2️⃣ **Verifica que la ruta de la carpeta del proyecto es correcta** en `generador.php`.  
3️⃣ **Revisa los permisos de la carpeta de destino** (`chmod 777` puede ser necesario en algunos casos).  
4️⃣ **Ejecuta el script desde la terminal** y revisa los errores de salida.  

---

## 🚀 **Conclusión**
Este script es una herramienta poderosa para **automatizar la generación de documentación** en proyectos PHP y CSS.  
Si tienes un código bien documentado, este script hará el trabajo por ti **sin esfuerzo**. 💡🔥  

📌 **¡Ahora solo configúralo y genera tu documentación en segundos!** 😃🚀  

---

## 📩 **Contacto**
Si tienes dudas, sugerencias o quieres mejorar este script, puedes ponerte en contacto conmigo a través de:

🔹 **GitHub:** [luisrocedev](https://github.com/luisrocedev)  
🔹 **LinkedIn:** [Luis Rodriguez](https://www.linkedin.com/in/luisrocedev/)  

🚀 **¡Gracias por usar este script!** 🎉
