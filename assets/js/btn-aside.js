const btn = document.querySelector(".icon-nav-arrow")
const bi = document.querySelector(".bi")
const logo = document.querySelector(".logo")
const logoHeder = document.querySelector(".logo-header")
const navLink = document.querySelectorAll("nav .nav-link .name-page")
const aside = document.querySelector("aside")
const header = document.querySelector("header")
const main = document.querySelector("main")

let nav = localStorage.getItem("nav") === "true" // Use localStorage instead of sessionStorage

function toggleNavClasses() {
	bi.classList.toggle("active", nav)
	btn.classList.toggle("active", nav)
	logo.classList.toggle("active", nav)
	logoHeder.classList.toggle("active", nav)
	navLink.forEach(element => {
		element.classList.toggle("active", nav)
	})
	aside.classList.add("opacity")
	header.classList.add("opacity")
	main.classList.add("opacity")
}

// Initialize classes based on stored state
toggleNavClasses()

btn.addEventListener("click", () => {
	nav = !nav
	localStorage.setItem("nav", nav) // Update localStorage

	toggleNavClasses()
})
