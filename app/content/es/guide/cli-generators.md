# Generación de código {#code-generation}

Los generadores crean archivos de la aplicación con la estructura esperada por Arix. Ejecútalos desde la raíz de tu aplicación.

## Generadores disponibles {#generators}

```sh
arix make:controller ArticleController
arix make:middleware ExampleMiddleware
arix make:view articles.index
arix make:test ArticleTest
arix make:test ArticleUnitTest --unit
```

Los controladores, middleware, vistas y pruebas Pest son puntos de partida: añade tu propio comportamiento y registra explícitamente las rutas o el middleware cuando sea necesario. `--unit` selecciona el directorio de pruebas unitarias.

## Destinos y archivos existentes {#targets}

Usa `--path=/path/to/application` al ejecutar desde otro directorio. Los archivos existentes no se reemplazan salvo que indiques explícitamente `--force`; inspecciona el destino antes de hacerlo. Consulta `--help` de cada comando para conocer sus argumentos.
