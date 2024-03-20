const btn = document.querySelector(".icon-nav-arrow")
const header = document.querySelector(".nav")
const bi = document.querySelector(".bi")
const aside = document.querySelector("aside")
const main = document.querySelector("main")
const logo = document.querySelector(".logo")

btn.addEventListener("click", () => {
	header.classList.toggle("active")
	btn.classList.toggle("active")
	aside.classList.toggle("active")
	main.classList.toggle("active")
	logo.classList.toggle("active")
})
