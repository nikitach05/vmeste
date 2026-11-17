import initOverflowSlider from './overflow-slider.js';

function initEventsSlider() {
    initOverflowSlider({
        rootSelector: '.events',
        sliderSelector: '.events__slider',
        paginationSelector: '.events__pagination',
        tabSelector: '.events__tab',
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initEventsSlider);
} else {
    initEventsSlider();
}
