function bindHeroTitle(text, section) {
    const state = { left: 0, width: 0 };
    let frame = 0;

    function measure() {
        const prev = text.style.transform;
        text.style.transform = 'none';
        const rect = text.getBoundingClientRect();
        state.left = rect.left;
        state.width = rect.width;
        text.style.transform = prev;
    }

    function update() {
        const distance = Math.max(section.offsetHeight * 0.55, 1);
        const progress = Math.min(1, Math.max(0, window.scrollY / distance));
        const eased = progress * progress * (3 - 2 * progress);
        const minScale = 0.34;
        const scale = 1 - eased * (1 - minScale);
        const translateX = eased * -(state.left + state.width * minScale + 32);

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

function initHeroTitle() {
    [
        ['.main__title-text', '.main'],
        ['.about-main__title-text', '.about-main'],
    ].forEach(([textSelector, sectionSelector]) => {
        const text = document.querySelector(textSelector);
        const section = document.querySelector(sectionSelector);
        if (text && section) bindHeroTitle(text, section);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroTitle);
} else {
    initHeroTitle();
}
