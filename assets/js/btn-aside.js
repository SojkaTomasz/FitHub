const btn = document.querySelector(".icon-nav-arrow")
const bi = document.querySelector(".bi")
const logo = document.querySelector(".logo")
const logoHeder = document.querySelector(".logo-header")
const navLink = document.querySelectorAll("nav .nav-link .name-page")

btn.addEventListener("click", () => {
	bi.classList.toggle("active")
	btn.classList.toggle("active")
	logo.classList.toggle("active")
	logoHeder.classList.toggle("active")
	navLink.forEach(element => {
		element.classList.toggle("active")
	})
})
