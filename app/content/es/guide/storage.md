# Almacenamiento de archivos {#file-storage}

El helper `storage()` permite acceder a archivos privados de la aplicación bajo `storage/app`. Este directorio está separado de los directorios públicos de medios, fuentes, estilos y scripts.

## Lectura y escritura {#reading-writing}

```php
storage()->put('notes/welcome.txt', 'Hello from Arix');

if (storage()->has('notes/welcome.txt')) {
    $message = storage()->get('notes/welcome.txt');
}
```

`put` crea los directorios padres que falten. Usa `append` y `prepend` para un archivo existente legible, o `delete` para eliminarlo. Las lecturas y operaciones sobre archivos ausentes pueden lanzar excepciones; gestiona los fallos según las necesidades de tu aplicación.

## Rutas y seguridad {#paths}

Las rutas son relativas a la raíz del almacenamiento. Se rechazan segmentos vacíos, `.`, `..`, rutas absolutas y rutas con enlaces. No consideres estas comprobaciones como autorización: asigna las entradas del visitante a archivos permitidos explícitamente y mantén privado el directorio de almacenamiento.

Las escrituras usan un archivo temporal que se renombra al destino. Añadir al principio o al final lee y reescribe el archivo; estas operaciones no sustituyen la coordinación de escrituras concurrentes.
