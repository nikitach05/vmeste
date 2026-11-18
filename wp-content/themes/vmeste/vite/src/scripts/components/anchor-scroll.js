export default class AnchorScroll {
	constructor(topOffset = 0) {
		this.topOffset = topOffset;
		this.init();
	}

	init() {
		document.querySelectorAll('a[href*="#"]').forEach((link) => {
			link.addEventListener("click", (e) => this.handleClick(e));
		});

		this.scrollToLocationHash();
	}

	getOffset() {
		if (this.topOffset) {
			return this.topOffset;
		}

		const header = document.querySelector(".header");
		return header ? header.offsetHeight : 0;
	}

	handleClick(e) {
		const link = e.currentTarget;
		let url;

		try {
			url = new URL(link.getAttribute("href"), window.location.href);
		} catch (error) {
			return;
		}

		const hash = url.hash;
		if (!hash || hash === "#") {
			return;
		}

		const samePage =
			url.origin === window.location.origin &&
			url.pathname === window.location.pathname;

		if (!samePage) {
			return;
		}

		const id = decodeURIComponent(hash.slice(1));
		const scrollTarget = document.getElementById(id);
		if (!scrollTarget) {
			return;
		}

		e.preventDefault();
		this.closeMobileMenu();
		this.scrollToElement(scrollTarget);

		if (window.location.hash !== hash) {
			history.pushState(null, "", hash);
		}
	}

	scrollToLocationHash() {
		const hash = window.location.hash;
		if (!hash || hash === "#") {
			return;
		}

		const id = decodeURIComponent(hash.slice(1));
		const scrollTarget = document.getElementById(id);
		if (!scrollTarget) {
			return;
		}

		window.scrollTo(0, 0);
		requestAnimationFrame(() => this.scrollToElement(scrollTarget));
	}

	scrollToElement(scrollTarget) {
		const elementPosition = scrollTarget.getBoundingClientRect().top;
		const offsetPosition =
			elementPosition + window.pageYOffset - this.getOffset();

		window.scrollTo({
			top: offsetPosition,
			behavior: "smooth",
		});
	}

	closeMobileMenu() {
		document.querySelector(".header")?.classList.remove("header--blur");
		document
			.querySelector(".mobile-menu")
			?.classList.remove("mobile-menu--opened");
		document.body.classList.remove("hidden");
	}
}
