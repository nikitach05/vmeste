function initFooterTitle() {
    const text = document.querySelector('.footer__title-text');
    const footer = document.querySelector('.footer');
    if (!text || !footer) return;

    const title = text.closest('.footer__title');
    const state = { left: 0, width: 0 };
    let frame = 0;

    function fitWidth() {
        const prev = text.style.transform;
        text.style.transform = 'none';
        const available = title.clientWidth;
        title.style.fontSize = '100px';
        const widthAt100 = text.getBoundingClientRect().width || 1;
        let size = (available / widthAt100) * 100;
        title.style.fontSize = `${size}px`;
        const fitted = text.getBoundingClientRect().width || 1;
        if (Math.abs(fitted - available) > 0.5) {
            size *= available / fitted;
            title.style.fontSize = `${size}px`;
        }
        text.style.transform = prev;
    }

    function measure() {
        fitWidth();
        const prev = text.style.transform;
        text.style.transform = 'none';
        const rect = text.getBoundingClientRect();
        state.left = rect.left;
        state.width = rect.width;
        text.style.transform = prev;
    }

    function update() {
        const maxScroll = Math.max(document.documentElement.scrollHeight - window.innerHeight, 0);
        const distance = Math.max(footer.offsetHeight * 0.9, window.innerHeight * 0.5, 1);
        const start = Math.max(maxScroll - distance, 0);
        const span = Math.max(maxScroll - start, 1);
        const progress = maxScroll === 0 ? 1 : Math.min(1, Math.max(0, (window.scrollY - start) / span));
        const eased = progress * progress * (3 - 2 * progress);
        const minScale = 0.34;
        const scale = minScale + eased * (1 - minScale);
        const translateX = (1 - eased) * -(state.left + state.width * minScale + 32);

        text.style.transform = `translate3d(${translateX.toFixed(2)}px, 0, 0) scale(${scale.toFixed(4)})`;
    }

    function onScroll() {
        cancelAnimationFrame(frame);
        frame = requestAnimationFrame(update);
    }

    function onResize() {
        measure();
        update();
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onResize);

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(onResize);
    }

    onResize();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFooterTitle);
} else {
    initFooterTitle();
}
