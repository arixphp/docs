# Assets

Stylesheets, scripts, fonts, and media live in public directories at your application root. The web server serves them directly; they do not pass through a PHP asset endpoint.

## Asset Helpers {#asset-helpers}

```php
style('app.css')
script('app.js')
font('inter.woff2', versioned: true)
media('logo.webp', versioned: true)
```

Stylesheets and scripts use content-based versions. Fonts and media can opt in to versioning. Paths are relative to the corresponding public directory.

Public directories are subject to the installed static asset policy, which permits specific file extensions; placing a file there does not guarantee the server will serve it. For example, the current policy excludes SVG. Consult `core/Assets/public-policy.json` for the installed policy and [deployment](deployment) for server-specific verification. Public asset directories must not contain symbolic links or private files.

## Managed Assets {#managed-assets}

The CLI manages `styles/arix/` and `scripts/arix/`. Put application-specific code outside those directories so updates do not overwrite it.

See [managed updates](cli-updates) for the `arix css:update` and `arix js:update` commands.

## Scripts {#scripts}

The main layout loads the application entry point as an ES module, without a build or JavaScript dependencies:

```html
<script type="module" src="{{ script('app.js') }}"></script>
```

In `scripts/app.js`, explicitly import the functions you need from `./arix/index.js`. Importing the module does not register components or intercept links or forms. The included entry point calls `enhance(document)` to opt elements marked with `data-arix-get` or `data-arix-post` into progressive enhancement; other links and forms retain their native behavior.

### Web Components {#web-components}

Web Components are optional and registered individually. For example, add the following to `scripts/app.js`:

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

If `app.js` already imports from that module, add `ArixElement` and `define` to the existing import. Then use the element in a view:

```html
<hello-button>
    <button type="button">Say hello</button>
</hello-button>
```

The element name must contain a hyphen. `define()` uses the native `customElements` registry: it requires browser support and does not install a polyfill. The base class uses Light DOM by default, so page styles apply. To isolate styles, create a Shadow DOM with `attachShadow()` in `setup()` and provide the necessary styles there.

`setup()` runs on the first connection, `render()` on every connection, and `teardown()` on disconnection. `on()` registers a listener on the element, and `link()` subscribes to a signal or computed value; both are automatically cleaned up on disconnection. Register them in `render()` if they must be restored on reconnection, as in the example. `emit()` dispatches a custom event that bubbles and crosses Shadow DOM boundaries by default. The component is responsible for creating or updating its content: `render()` is a hook, not an automatic template engine.

### Lifecycle, Signals, and Shadow DOM {#component-lifecycle}

This standalone example creates a counter with isolated styles. Add it to `scripts/app.js` and add the names to the existing import if you already import from `./arix/index.js`:

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

Place `<click-counter></click-counter>` in a view. `setup()` creates the button and signal once. `render()` displays the current value and reconnects the listener and subscription; `link()` does not deliver the initial value by itself. When the element is removed from the DOM, `teardown()` removes the attribute and the base class releases the listener and subscription. If reinserted, the element retains its count and `render()` restores both. The `document` listener belongs to the application and is not automatically cleaned up with the component.

The constructed stylesheet is adopted inside the Shadow DOM; global rules do not directly select its button. `emit()` makes the change observable from outside. This example requires browsers that support Custom Elements, Shadow DOM, and constructable stylesheets.

## Styles {#styles}

The layout loads `styles/app.css` using `style('app.css')`. This file declares the layers in the order `theme`, `base`, `components`, `utilities`, and `application`, and imports `arix/tokens.css`, `arix/base.css`, `arix/components.css`, `arix/utilities.css`, and the application-owned `theme.css`. Styles use native CSS and require no build.

To customize a semantic variable without editing managed files, add for example to `styles/theme.css`:

```css
@layer application {
    :root {
        --color-accent: #0e8c6f;
    }
}
```

Add your own rules in the `application` layer and keep the layer order declaration in `app.css`. The helpers version the entry file based on its contents; JavaScript modules and CSS files imported through relative paths do not automatically inherit that hash. Account for this when configuring caching for those files.
