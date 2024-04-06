const progressBar = document.querySelector(".progress-bar")
document.addEventListener("DOMContentLoaded", function () {
	if (progressBar) {
		let number = 0
		const valueProgressBar = progressBar.getAttribute("data-value")
		const intervalId = setInterval(() => {
			number++
			progressBar.style.width = `${number}%`
			if (valueProgressBar <= number) {
				clearInterval(intervalId)
			}
		}, 20)
	}
})
