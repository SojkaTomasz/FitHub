const btn = document.querySelector(".icon-array-nav")
const header = document.querySelector(".nav")

btn.addEventListener("click", () => {
	header.classList.toggle("active")
})
