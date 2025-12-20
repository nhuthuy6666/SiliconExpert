import $ from 'jquery';

window.jQuery = $;
window.$ = $;

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import './main.scss';
import './blocks-entry';

const setFooterRevealHeight = () => {
	const footer = document.getElementById('colophon');
	if (!footer) return;
	const height = footer.getBoundingClientRect().height;
	document.documentElement.style.setProperty('--se-footer-height', `${height}px`);
};

window.addEventListener('load', setFooterRevealHeight);
window.addEventListener('resize', setFooterRevealHeight);
