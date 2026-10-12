document.addEventListener("DOMContentLoaded", () => {
	// Mobile menu btn toggle
	const btnMenu = document.querySelector(".menu-toggle");
	btnMenu.addEventListener("click", onClicktoggleMenu);

	document
		.querySelector(".mobile-menu__close")
		.addEventListener("click", onClicktoggleMenu);

	function onClicktoggleMenu(e) {
		toggleMenu();

		if (
			document
				.querySelector(".mobile-menu")
				.classList.contains("mobile-menu--opened")
		) {
			bodyHidden(true);
		} else {
			bodyHidden(false);
		}
	}

	function toggleMenu() {
		document.querySelector(".header").classList.toggle("header--blur");
		document
			.querySelector(".mobile-menu")
			.classList.toggle("mobile-menu--opened");
	}

	function bodyHidden(state) {
		if (state) {
			document.body.classList.add("hidden");
		} else {
			document.body.classList.remove("hidden");
		}
	}

	// Set height for mobile menu
	window.addEventListener("resize", () => {
		requestAnimationFrame(setMenuHeight);
	});

	function setMenuHeight() {
		const menu = document.querySelector(".mobile-menu");
		menu.style.height = window.innerHeight + "px";
	}

	setMenuHeight();
});