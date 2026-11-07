# Recursos {#assets}

Las hojas de estilo, scripts, fuentes y medios están en directorios públicos en la raíz de la aplicación. El servidor los entrega directamente, sin pasar por un endpoint PHP.

## Helpers de recursos {#asset-helpers}

```php
style('app.css')
script('app.js')
font('inter.woff2', versioned: true)
media('logo.webp', versioned: true)
```

Las hojas de estilo y los scripts utilizan versiones basadas en su contenido. Las fuentes y los medios pueden activar el versionado. Las rutas son relativas al directorio público correspondiente.

Los directorios públicos están sujetos a la política de recursos estáticos instalada, que permite extensiones específicas; colocar un archivo allí no garantiza que el servidor lo entregue. Por ejemplo, la política actual excluye SVG. Consulta `core/Assets/public-policy.json` para conocer la política instalada y [despliegue](deployment) para verificarla en tu servidor. Los directorios públicos de recursos no deben contener enlaces simbólicos ni archivos privados.

## Recursos administrados {#managed-assets}

La CLI administra `styles/arix/` y `scripts/arix/`. Coloca el código propio de la aplicación fuera de esos directorios para que las actualizaciones no lo sobrescriban.

Consulta [actualizaciones administradas](cli-updates) para conocer los comandos `arix css:update` y `arix js:update`.

## Scripts {#scripts}

La plantilla principal carga el punto de entrada de la aplicación como un módulo ES, sin compilación ni dependencias JavaScript:

```html
<script type="module" src="{{ script('app.js') }}"></script>
```

En `scripts/app.js`, importa explícitamente las funciones que necesites desde `./arix/index.js`. Importar el módulo no registra componentes ni intercepta enlaces o formularios. El punto de entrada incluido llama a `enhance(document)` para activar la mejora progresiva de elementos con `data-arix-get` o `data-arix-post`; los demás enlaces y formularios conservan su comportamiento nativo.

### Web Components {#web-components}

Los Web Components son opcionales y se registran individualmente. Por ejemplo, añade lo siguiente a `scripts/app.js`:

```js
import { ArixElement, define } from './arix/index.js';

class HelloButton extends ArixElement {
    render() {
        this.on('click', (event) => {
            if (event.target.closest('button')) {
                this.emit('hello', { message: 'Hello!' });
            }
        });
    }
}

define('hello-button', HelloButton);
```

Si `app.js` ya importa desde ese módulo, añade `ArixElement` y `define` a la importación existente. Después usa el elemento en una vista:

```html
<hello-button>
    <button type="button">Say hello</button>
</hello-button>
```

El nombre del elemento debe contener un guion. `define()` utiliza el registro nativo `customElements`: necesita compatibilidad del navegador y no instala un polyfill. La clase base usa Light DOM por defecto, por lo que se aplican los estilos de la página. Para aislar estilos puedes crear un Shadow DOM con `attachShadow()` en `setup()` y proporcionar allí los estilos necesarios.

`setup()` se llama en la primera conexión, `render()` en cada conexión y `teardown()` al desconectar. `on()` registra un listener en el elemento y `link()` suscribe una señal o valor computado; ambos se limpian automáticamente al desconectar. Regístralos en `render()` si deben restablecerse al reconectar, como en el ejemplo. `emit()` despacha un evento personalizado que, por defecto, burbujea y atraviesa los límites de Shadow DOM. El componente es responsable de crear o actualizar su contenido: `render()` es un hook, no un motor de plantillas automático.

### Ciclo de vida, señales y Shadow DOM {#component-lifecycle}

Este ejemplo independiente crea un contador con estilos aislados. Añádelo a `scripts/app.js` e incorpora los nombres a la importación existente si ya importas desde `./arix/index.js`:

```js
import { ArixElement, define, signal } from './arix/index.js';

class ClickCounter extends ArixElement {
    setup() {
        this.count = signal(0);
        const root = this.attachShadow({ mode: 'open' });
        const styles = new CSSStyleSheet();
        styles.replaceSync('button { color: teal; font: inherit; }');
        root.adoptedStyleSheets = [styles];

        const button = document.createElement('button');
        button.type = 'button';
        root.append(button);
    }

    render() {
        const button = this.$('button');
        const updateLabel = (value) => {
            button.textContent = `Count: ${value}`;
        };

        updateLabel(this.count.get());
        this.link(this.count, updateLabel);
        this.on('click', () => {
            this.count.update((value) => value + 1);
            this.emit('count-change', { count: this.count.get() });
        });
        this.setAttribute('data-connected', '');
    }

    teardown() {
        this.removeAttribute('data-connected');
    }
}

define('click-counter', ClickCounter);

document.addEventListener('count-change', (event) => {
    console.log('Count:', event.detail.count);
});
```

En una vista, coloca `<click-counter></click-counter>`. `setup()` crea el botón y la señal una sola vez. `render()` muestra el valor actual y vuelve a conectar el listener y la suscripción; `link()` no envía el valor inicial por sí solo. Al retirar el elemento del DOM, `teardown()` elimina el atributo y la clase base libera el listener y la suscripción. Si lo vuelves a insertar, conserva la cuenta y `render()` restablece ambos. El listener de `document` pertenece a la aplicación y no se limpia automáticamente con el componente.

La hoja construida se adopta dentro del Shadow DOM; las reglas globales no seleccionan directamente su botón. `emit()` permite observar el cambio desde fuera. Este ejemplo requiere navegadores compatibles con Custom Elements, Shadow DOM y hojas de estilo construibles.

## Estilos {#styles}

La plantilla carga `styles/app.css` mediante `style('app.css')`. Este archivo declara las capas, en orden `theme`, `base`, `components`, `utilities` y `application`, e importa `arix/tokens.css`, `arix/base.css`, `arix/components.css`, `arix/utilities.css` y el archivo propio `theme.css`. Los estilos son CSS nativo y no requieren compilación.

Para personalizar una variable semántica sin editar los archivos administrados, añade por ejemplo a `styles/theme.css`:

```css
@layer application {
    :root {
        --color-accent: #0e8c6f;
    }
}
```

Añade tus reglas propias en la capa `application` y conserva la declaración de orden de capas en `app.css`. Los helpers versionan el archivo de entrada según su contenido; los módulos JavaScript y hojas CSS importados con rutas relativas no heredan automáticamente ese hash. Tenlo en cuenta al configurar la caché de esos archivos.
