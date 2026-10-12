export default class ClientsMarquee {
    constructor(root, options = {}) {
        this.root = root;
        this.itemSelector = options.itemSelector || '.main__clients-item';
        this.speed = Number(root.dataset.marqueeSpeed) || options.speed || 60;
        this.templates = [...root.querySelectorAll(`:scope > ${this.itemSelector}`)].map((item) => item.cloneNode(true));
        this.lastWidth = 0;
        this.frame = 0;
        this.generation = 0;
        this.imagesSettled = document.readyState === 'complete';

        if (!this.templates.length) return;

        this.onResize = this.onResize.bind(this);
        this.build();

        this.resizeObserver = new ResizeObserver(this.onResize);
        this.resizeObserver.observe(this.root);

        if (!this.imagesSettled) {
            window.addEventListener('load', () => {
                this.imagesSettled = true;
                this.build();
            }, { once: true });
        }
    }

    onResize() {
        cancelAnimationFrame(this.frame);
        this.frame = requestAnimationFrame(() => {
            if (Math.abs(this.root.clientWidth - this.lastWidth) < 1) return;
            this.build();
        });
    }

    appendSet(track) {
        this.templates.forEach((template) => {
            const item = template.cloneNode(true);
            item.querySelectorAll('img').forEach((img) => {
                img.loading = 'eager';
            });
            track.appendChild(item);
        });
    }

    build() {
        const width = this.root.clientWidth;
        if (!width || !this.templates.length) return;

        const track = document.createElement('div');
        track.className = 'main__clients-track';
        this.root.replaceChildren(track);

        let guard = 0;
        do {
            this.appendSet(track);
            guard += 1;
        } while (guard < 40 && track.scrollWidth < width);

        const clone = track.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        this.root.appendChild(clone);

        const distance = track.scrollWidth;
        this.root.style.setProperty('--clients-duration', `${distance / this.speed}s`);
        this.lastWidth = this.root.clientWidth;

        if (!this.imagesSettled) this.waitImages(track);
    }

    waitImages(track) {
        const pending = [...track.querySelectorAll('img')].filter((img) => !img.complete);
        if (!pending.length) {
            this.imagesSettled = true;
            return;
        }

        const generation = ++this.generation;
        let left = pending.length;

        const done = () => {
            if (generation !== this.generation) return;
            left -= 1;
            if (left > 0) return;
            this.imagesSettled = true;
            this.build();
        };

        pending.forEach((img) => {
            img.addEventListener('load', done, { once: true });
            img.addEventListener('error', done, { once: true });
        });
    }
}

function initClientsMarquee() {
    document.querySelectorAll('.main__clients').forEach((el) => {
        if (el.dataset.clientsMarquee) return;
        el.dataset.clientsMarquee = 'ready';
        new ClientsMarquee(el);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initClientsMarquee);
} else {
    initClientsMarquee();
}
