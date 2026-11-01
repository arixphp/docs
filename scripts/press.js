export function enhancePress(root) {
    const press = root.querySelector('[data-press]');
    const figure = press?.querySelector('.press-figure');
    const steps = press?.querySelectorAll('[data-press-step]');

    if (!press || !figure || steps.length !== 3) {
        return;
    }

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const sheet = press.querySelector('.press-sheet');
    let timer;
    let visible = !('IntersectionObserver' in window);

    function showStep(index) {
        press.dataset.step = String(index);
        steps.forEach((step, position) => {
            if (position === index) {
                step.setAttribute('aria-current', 'step');
            } else {
                step.removeAttribute('aria-current');
            }
        });
        figure.textContent = `0${index + 1} / 03`;
    }

    function schedule() {
        clearTimeout(timer);

        if (reducedMotion.matches || !visible || document.hidden) {
            return;
        }

        timer = setTimeout(() => {
            showStep((Number(press.dataset.step) + 1) % steps.length);
            schedule();
        }, 1800);
    }

    function synchronize() {
        const running = !reducedMotion.matches && visible && !document.hidden;
        sheet?.getAnimations().forEach((animation) => running ? animation.play() : animation.pause());
        schedule();
    }
    showStep(0);
    reducedMotion.addEventListener('change', synchronize);
    document.addEventListener('visibilitychange', synchronize);

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            visible = entries[0].isIntersecting;
            synchronize();
        });
        observer.observe(press);
    }

    synchronize();
}
