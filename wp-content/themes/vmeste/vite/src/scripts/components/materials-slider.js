import initOverflowSlider from './overflow-slider.js';

function matchMaterialsSlide(slide, filter) {
    const type = slide.dataset.type;
    const isExpert = slide.hasAttribute('data-expert');

    return (
        filter === 'all' ||
        (filter === 'expert' ? isExpert : type === filter)
    );
}

function initMaterialsSlider() {
    initOverflowSlider({
        rootSelector: '.materials',
        sliderSelector: '.materials__slider',
        paginationSelector: '.materials__pagination',
        tabSelector: '.materials__tab',
        matchSlide: matchMaterialsSlide,
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMaterialsSlider);
} else {
    initMaterialsSlider();
}
