let hamburgerNav = document.getElementById("hamburger-nav");
let item = document.getElementById("dropdown-item");


// for navbar
hamburgerNav.addEventListener("click", () => {
	let navbar = document.getElementById("left-navbar");
	let line1 = document.getElementsByClassName("line1")[0];
	let line2 = document.getElementsByClassName("line2")[0];
	let line3 = document.getElementsByClassName("line3")[0];
	let span = document.getElementsByClassName("navbar-span");
	let container = document.getElementById("main-container");

		for (let i = 0; i < span.length; i++) {
			span[i].classList.toggle("active");
		}
		 navbar.classList.toggle("left-navbar-links-active");
		 line1.classList.toggle("line1-style");
		 line2.classList.toggle("line2-style");
		 line3.classList.toggle("line3-style");
		 hamburgerNav.classList.toggle("hamburger-active");
		 container.classList.toggle("main-container-active");	
});

// for dropdown
item.addEventListener("click", () => {
	let linkItem = document.getElementById("items-hide");

	linkItem.classList.toggle("items-active");
});
