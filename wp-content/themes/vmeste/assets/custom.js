document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-scroll]').forEach((el) => {
        el.addEventListener('click', (e) => {
            const target = document.querySelector(el.getAttribute('data-scroll'));
            if (!target) {
                return;
            }
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
});
