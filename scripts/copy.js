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

        const button = document.createElement('button');
        const status = document.createElement('span');
        button.type = 'button';
        button.className = 'copy-code';
        button.textContent = 'Copy code';
        status.className = 'copy-status';
        status.setAttribute('role', 'status');

        button.addEventListener('click', async () => {
            const copied = await copyText(clipboard, code.textContent);
            status.textContent = copied ? 'Copied.' : 'Could not copy. Select the code to copy it.';
        });

        pre.before(button);
        button.after(status);
    });
}
