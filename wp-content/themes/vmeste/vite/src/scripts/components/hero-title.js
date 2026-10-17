const MAX_WIDTH = 280;

function bindHeroTitle(text, section) {
    const state = { left: 0, top: 0, width: 0, height: 0 };
    let frame = 0;

    function measure() {
        const title = text.parentElement;

        title.style.minHeight = '';
        text.style.position = 'static';
        text.style.left = 'auto';
        text.style.top = 'auto';
        text.style.margin = '';
        text.style.transform = 'none';

        const rect = text.getBoundingClientRect();
        state.left = rect.left + window.scrollX;
        state.top = rect.top + window.scrollY;
        state.width = rect.width;
        state.height = rect.height;
        title.style.minHeight = `${title.getBoundingClientRect().height}px`;
        measureInk();
    }

    function measureInk() {
        const cs = getComputedStyle(text);
        const holder = document.createElement('div');
        holder.style.cssText = 'position:absolute;visibility:hidden;left:0;top:0;pointer-events:none;';

        const span = document.createElement('span');
        span.style.font = cs.font;
        span.style.lineHeight = cs.lineHeight;
        span.style.display = 'inline-block';
        span.style.whiteSpace = 'nowrap';
        span.textContent = text.textContent;

        const marker = document.createElement('span');
        marker.style.cssText = 'display:inline-block;width:0;height:0;vertical-align:baseline;';
        span.appendChild(marker);

        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        const svgText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        svgText.setAttribute('font-family', cs.fontFamily.replace(/["']/g, ''));
        svgText.setAttribute('font-size', String(parseFloat(cs.fontSize)));
        svgText.textContent = text.textContent.trim();
        svg.appendChild(svgText);

        holder.append(span, svg);
        document.body.appendChild(holder);

        const bbox = svgText.getBBox();
        const baseline = marker.offsetTop;
        state.inkTop = baseline + bbox.y;
        state.inkBottom = baseline + bbox.y + bbox.height;
        holder.remove();
    }

    function target() {
        const header = document.querySelector('.header');
        const headerRect = header.getBoundingClientRect();
        const left = parseFloat(getComputedStyle(header.querySelector('.container')).paddingLeft) || 0;

        let maxWidth = MAX_WIDTH;
        header.querySelectorAll('.header__menu, .menu-toggle').forEach((el) => {
            if (getComputedStyle(el).display === 'none' || el.offsetWidth <= 0) return;
            const edge = el.getBoundingClientRect().left - left - 24;
            if (edge > 0) maxWidth = Math.min(maxWidth, edge);
        });

        const pad = 6;
        const inkHeight = Math.max(state.inkBottom - state.inkTop, state.height);
        const heightScale = (headerRect.height - pad * 2) / inkHeight;
        const endScale = Math.min(1, maxWidth / state.width, heightScale);
        const scaledInkTop = state.inkTop * endScale;
        const scaledInkHeight = inkHeight * endScale;
        const visualTop = headerRect.top + (headerRect.height - scaledInkHeight) / 2;
        const top = visualTop - scaledInkTop;

        return { left, top, endScale };
    }

    function update() {
        const distance = Math.max(section.offsetHeight * 0.55, 1);
        const progress = Math.min(1, Math.max(0, window.scrollY / distance));
        const eased = progress * progress * (3 - 2 * progress);
        const { left, top, endScale } = target();
        const startLeft = state.left - window.scrollX;
        const startTop = state.top - window.scrollY;
        const x = startLeft + (left - startLeft) * eased;
        const y = startTop + (top - startTop) * eased;
        const scale = 1 - eased * (1 - endScale);

        text.style.position = 'fixed';
        text.style.left = '0';
        text.style.top = '0';
        text.style.margin = '0';
        text.style.zIndex = '110';
        text.style.transformOrigin = 'left top';
        text.style.transform = `translate3d(${x.toFixed(2)}px, ${y.toFixed(2)}px, 0) scale(${scale.toFixed(4)})`;
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
