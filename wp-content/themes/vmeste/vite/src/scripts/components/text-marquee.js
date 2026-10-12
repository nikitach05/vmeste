export default class TextMarquee {
    constructor(root, options = {}) {
        this.root = root;
        this.speed = Number(root.dataset.marqueeSpeed) || options.speed || 80;
        this.text = root.textContent.replace(/\s+/g, ' ').trim();
        this.lastWidth = 0;
        this.frame = 0;

        if (!this.text) return;

        this.onResize = this.onResize.bind(this);
        this.build();

        this.resizeObserver = new ResizeObserver(this.onResize);
        this.resizeObserver.observe(this.root);

        if (document.fonts && document.fonts.status !== 'loaded') {
            document.fonts.ready.then(() => this.build());
        }
    }

    onResize() {
        cancelAnimationFrame(this.frame);
        this.frame = requestAnimationFrame(() => {
            if (Math.abs(this.root.clientWidth - this.lastWidth) < 1) return;
            this.build();
        });
    }

    appendPhrase(track) {
        const phrase = document.createElement('span');
        phrase.className = 'marquee-text__phrase';
        phrase.textContent = this.text;
        track.appendChild(phrase);
    }

    build() {
        const width = this.root.clientWidth;
        if (!width || !this.text) return;

        const track = document.createElement('div');
        track.className = 'marquee-text__track';
        this.root.replaceChildren(track);

        let guard = 0;
        do {
            this.appendPhrase(track);
            guard += 1;
        } while (guard < 40 && track.scrollWidth < width);

        const clone = track.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        this.root.appendChild(clone);

        const distance = track.scrollWidth;
        this.root.style.setProperty('--marquee-duration', `${distance / this.speed}s`);
        this.lastWidth = this.root.clientWidth;
    }
}

function initTextMarquee() {
    document.querySelectorAll('.marquee-text__item').forEach((el) => {
        if (el.dataset.textMarquee) return;
        el.dataset.textMarquee = 'ready';
        new TextMarquee(el);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTextMarquee);
} else {
    initTextMarquee();
}
