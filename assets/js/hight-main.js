const titleSection = document.querySelector(".title-section")
const header = document.querySelector("header")
const section = document.querySelector("section")

const setHeight = () => {
	const sumHight = titleSection.offsetHeight + header.offsetHeight
	section.style.height = "calc(100vh - " + sumHight + "px)"
}
addEventListener("resize", setHeight)
document.addEventListener("DOMContentLoaded", setHeight)