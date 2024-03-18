const btn = document.querySelector(".icon-nav-arrow")
const header = document.querySelector(".nav")
const bi = document.querySelector(".bi")

btn.addEventListener("click", () => {
	header.classList.toggle("active")
	btn.classList.toggle("active")
})
