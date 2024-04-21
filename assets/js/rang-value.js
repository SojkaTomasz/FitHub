const valueRange = document.querySelector(".input-percent-diet")
const labelRange = document.querySelector(".label-percent-diet")

if (valueRange) {
	const span = document.createElement("strong")
	span.innerHTML = ` ${valueRange.value}%`
	labelRange.appendChild(span)
	valueRange.addEventListener("input", () => {
		span.innerHTML = ` ${valueRange.value}%`
	})
}
