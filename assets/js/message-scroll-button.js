const boxMessages = document.querySelector(".box-messages")

document.addEventListener("DOMContentLoaded", () => {
	if (boxMessages) boxMessages.scrollTop = boxMessages.scrollHeight
})
