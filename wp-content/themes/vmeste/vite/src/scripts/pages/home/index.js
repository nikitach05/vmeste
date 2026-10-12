import '../../components/clients-marquee.js';
import '../../components/text-marquee.js';
import '../../components/steps-scroll.js';
import '../../components/hero-title.js';
import '../../components/environment-cards.js';
import ShowBlockByTab from '../../components/show-block-by-tab.js';

function initPartners() {
    const root = document.querySelector('.partners');
    if (!root) return;
    new ShowBlockByTab(root);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPartners);
} else {
    initPartners();
}
