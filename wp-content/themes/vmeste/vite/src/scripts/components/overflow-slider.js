import Swiper from 'swiper';
import { Pagination } from 'swiper/modules';

function isSlideVisible(slide) {
    return !slide.classList.contains('swiper-slide-hidden') && slide.style.display !== 'none';
}

function updatePrevSlides(swiper) {
    swiper.slides.forEach((slide, index) => {
        if (!isSlideVisible(slide)) {
            slide.classList.remove('is-prev-hidden');
            return;
        }

        slide.classList.toggle('is-prev-hidden', index < swiper.activeIndex);
    });
}

function refreshPagination(swiper) {
    if (!swiper.pagination?.el) return;
    swiper.pagination.render();
    swiper.pagination.update();
}

function filterSlides(swiper, root, filter, matchSlide) {
    const slides = [...root.querySelectorAll('.swiper-slide')];
    let firstVisible = -1;

    slides.forEach((slide, index) => {
        const match = matchSlide(slide, filter);
        slide.classList.toggle('swiper-slide-hidden', !match);
        slide.style.display = match ? '' : 'none';

        if (match && firstVisible < 0) {
            firstVisible = index;
        }
    });

    swiper.update();
    swiper.slideTo(Math.max(firstVisible, 0), 0);
    refreshPagination(swiper);
    updatePrevSlides(swiper);
}

export default function initOverflowSlider({
    rootSelector,
    sliderSelector,
    paginationSelector,
    tabSelector,
    matchSlide = (slide, filter) => filter === 'all' || slide.dataset.type === filter,
}) {
    const root = document.querySelector(rootSelector);
    if (!root) return null;

    const sliderEl = root.querySelector(sliderSelector);
    const paginationEl = root.querySelector(paginationSelector);
    if (!sliderEl) return null;

    const swiper = new Swiper(sliderEl, {
        modules: [Pagination],
        slidesPerView: 3.2,
        spaceBetween: 16,
        speed: 500,
        watchOverflow: true,
        pagination: {
            el: paginationEl,
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1.12,
                spaceBetween: 12,
            },
            578: {
                slidesPerView: 1.45,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 2.25,
                spaceBetween: 16,
            },
            992: {
                slidesPerView: 3.15,
                spaceBetween: 16,
            },
            1280: {
                slidesPerView: 3.2,
                spaceBetween: 16,
            },
        },
        on: {
            init(instance) {
                updatePrevSlides(instance);
            },
            slideChange(instance) {
                updatePrevSlides(instance);
            },
            resize(instance) {
                updatePrevSlides(instance);
            },
        },
    });

    const tabs = root.querySelectorAll(tabSelector);
    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            if (tab.classList.contains('active')) return;

            tabs.forEach((item) => item.classList.remove('active'));
            tab.classList.add('active');
            filterSlides(swiper, root, tab.dataset.filter || 'all', matchSlide);
        });
    });

    return swiper;
}
