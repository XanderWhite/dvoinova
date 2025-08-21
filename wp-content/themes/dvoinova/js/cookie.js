function init() {
	const elem = document.querySelector(".cookie");
	const button = elem.querySelector(".cookie__button");

	if (!getCookie("visited")) {
		elem.classList.remove("hide");
	} else {
		setCookie(elem);
	}

	button.addEventListener("click", () => {
		setCookie(elem);
	});
}

document.addEventListener("DOMContentLoaded", init);

function getCookie(name) {
	const cookies = document.cookie.split('; ');
	for (const cookie of cookies) {
		const [cookieName, cookieValue] = cookie.split('=');
		if (cookieName === name) {
			return decodeURIComponent(cookieValue);
		}
	}
	return undefined;
}

function setCookie(elem) {
	const date = new Date();
	date.setTime(date.getTime() + 30 * 24 * 60 * 60 * 1000);
	document.cookie = `visited=true; expires=${date.toUTCString()}; path=/`;

	elem.classList.add("hide");
}
