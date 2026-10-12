function initEnvironmentCards() {
    const root = document.querySelector('.environment__cards');
    if (!root || root.dataset.environmentCards) return;

    const templates = [...root.children].map((node) => node.cloneNode(true));
    if (!templates.length) return;

    root.dataset.environmentCards = 'ready';

    const desktopQuery = window.matchMedia('(min-width: 992px)');
    const speed = Number(root.dataset.marqueeSpeed) || 36;
    let frame = 0;
    let mode = null;
    let height = 0;

    function appendSet(track) {
        templates.forEach((template) => track.appendChild(template.cloneNode(true)));
    }

    function build() {
        const desktop = desktopQuery.matches;
        const nextHeight = root.clientHeight;

        if (desktop === mode && (!desktop || Math.abs(nextHeight - height) < 2)) return;

        mode = desktop;
        height = nextHeight;
        root.replaceChildren();
        root.style.removeProperty('--environment-duration');

        if (!desktop) {
            templates.forEach((template) => root.appendChild(template.cloneNode(true)));
            return;
        }

        const track = document.createElement('div');
        track.className = 'environment__track';
        root.appendChild(track);

        let guard = 0;
        do {
            appendSet(track);
            guard += 1;
        } while (guard < 12 && track.scrollHeight < root.clientHeight);

        const clone = track.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        root.appendChild(clone);

        root.style.setProperty('--environment-duration', `${track.scrollHeight / speed}s`);
    }

    function onResize() {
        cancelAnimationFrame(frame);
        frame = requestAnimationFrame(build);
    }

    desktopQuery.addEventListener('change', onResize);
    window.addEventListener('resize', onResize);

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(onResize);
    }

    build();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initEnvironmentCards);
} else {
    initEnvironmentCards();
}
