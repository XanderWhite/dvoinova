document.addEventListener('DOMContentLoaded', ()=>{
	const elem = document.querySelector('.cookie');
	const button = elem.querySelector('.cookie__button');

	const getCookie = (name) => {
		const matches = document.cookie.match(new RegExp(
			"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
		));
		return matches ? decodeURIComponent(matches[1]) : undefined;
	};

	if (!getCookie('visited')) {
		elem.style.display = 'block';
	}

	button.addEventListener('click', () => {
		const date = new Date();
		date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
		document.cookie = `visited=true; expires=${date.toUTCString()}; path=/`;

		elem.style.display = 'none';
	});

	if (getCookie('visited')) {
		const date = new Date();
		date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
		document.cookie = `visited=true; expires=${date.toUTCString()}; path=/`;
	}
});