function initStepsScroll() {
    const root = document.querySelector('.steps');
    if (!root) return;

    const items = [...root.querySelectorAll('.steps__item')];
    const images = [...root.querySelectorAll('.steps__panel-media img')];
    const title = root.querySelector('.steps__panel-title');
    if (!items.length) return;

    let current = -1;
    let frame = 0;

    function setActive(index) {
        if (index === current) return;
        current = index;

        items.forEach((item, i) => {
            item.classList.toggle('steps__item--active', i === index);
        });

        images.forEach((img, i) => {
            img.classList.toggle('is-active', i === index);
        });

        const name = items[index].querySelector('.steps__name');
        if (title && name) title.textContent = name.textContent.trim();
    }

    function update() {
        const line = window.innerHeight * 0.55;
        let index = 0;

        items.forEach((item, i) => {
            if (item.getBoundingClientRect().top <= line) index = i;
        });

        setActive(index);
    }

    function onScroll() {
        cancelAnimationFrame(frame);
        frame = requestAnimationFrame(update);
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initStepsScroll);
} else {
    initStepsScroll();
}
