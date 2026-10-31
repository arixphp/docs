export function tokenizePhp(source) {
    const pattern = /(?<comment>\/\*[\s\S]*?(?:\*\/|$)|\/\/[^\r\n]*|\#[^\r\n]*)|(?<string>'(?:\\[\s\S]|[^'\\])*'|"(?:\\[\s\S]|[^"\\])*")|(?<variable>\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*)|(?<keyword><\?php\b|\b(?:abstract|and|array|as|break|callable|case|catch|class|clone|const|continue|declare|default|do|echo|else|elseif|enum|extends|false|finally|fn|foreach|for|function|if|implements|include|include_once|instanceof|interface|match|namespace|new|null|or|private|protected|public|readonly|require|require_once|return|static|switch|throw|trait|true|try|use|while|xor|yield)\b)|(?<number>\b\d+(?:\.\d+)?\b)/gi;
    const tokens = [];
    let position = 0;

    for (const match of source.matchAll(pattern)) {
        if (match.index > position) {
            tokens.push({ type: null, text: source.slice(position, match.index) });
        }

        const type = Object.keys(match.groups).find(name => match.groups[name] !== undefined);
        tokens.push({ type, text: match[0] });
        position = match.index + match[0].length;
    }

    if (position < source.length) {
        tokens.push({ type: null, text: source.slice(position) });
    }

    return tokens;
}

export async function copyText(clipboard, text) {
    try {
        if (!clipboard?.writeText) {
            return false;
        }

        await clipboard.writeText(text);

        return true;
    } catch {
        return false;
    }
}

export function enhanceCodeExamples(root, clipboard) {
    root.querySelectorAll('.guide-content pre').forEach(pre => {
        const code = pre.querySelector('code');

        if (!code) {
            return;
        }

        if (code.classList?.contains('language-php')) {
            const nodes = tokenizePhp(code.textContent).map(token => {
                if (!token.type) {
                    return document.createTextNode(token.text);
                }

                const span = document.createElement('span');
                span.className = `php-${token.type}`;
                span.textContent = token.text;

                return span;
            });
            code.replaceChildren(...nodes);
        }

        const container = document.createElement('div');
        const button = document.createElement('button');
        const status = document.createElement('span');
        container.className = 'code-example';
        button.type = 'button';
        button.className = 'copy-code';
        button.textContent = 'Copy code';
        status.className = 'copy-status';
        status.setAttribute('role', 'status');

        button.addEventListener('click', async () => {
            const copied = await copyText(clipboard, code.textContent);
            status.textContent = copied ? 'Copied.' : 'Could not copy. Select the code to copy it.';
        });

        pre.before(container);
        container.append(pre, button, status);
    });
}
