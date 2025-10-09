document.addEventListener("DOMContentLoaded", () => {
	const showModalBtn = document.getElementById("review-showModal-btn");

	const modal = document.getElementById("review-modal");

		if (!showModalBtn || !modal ) {
        return;
    }

	const modalCloseBtn = modal.querySelector("#review-modal__close-btn");
	const mask = modal.querySelector(".mask");
    const form = modal.querySelector("#review-form");
    const fileInput = form.querySelector("#review-file-input");
    const filePreview = form.querySelector("#review-file-preview");
    const clearFormBtn = form.querySelector("#review-clear-form-btn");
	const yandexClientKey = 'ysc1_lA9Ctlvraa8ZXeRN6RLQ0fkBqq9YALAWKAd9EDvg81f87b82';

	let captchaWidgetId = null;

 // Функция для закрытия модального окна
    function closeModal() {
        if (modal && typeof modal.close === "function") {
            modal.close();
        }
        document.body.classList.remove("no-scroll");

		 // Сбрасываем капчу при закрытии модального окна
        if (captchaWidgetId && typeof YaCaptcha !== 'undefined') {
            YaCaptcha.reset(captchaWidgetId);
        }
    }

    // Обработчик закрытия модального окна (на случай других способов закрытия)
    modal.addEventListener('close', closeModal);

    //открываем модальное окно
	showModalBtn.addEventListener("click", () => {
		document.body.classList.add("no-scroll");
		modal.showModal();
		setTimeout(initCaptcha, 500);
		document.getElementById("author-input").focus();
	});

	//закрываем модальное окно
	modalCloseBtn.addEventListener("click", () => {
        closeModal();
	});

	// Функция инициализации капчи
    function initCaptcha() {
		console.log('captcha')
		console.log(YaCaptcha)
        if (typeof YaCaptcha !== 'undefined') {
            captchaWidgetId = YaCaptcha.init('#review-captcha-container', {
                sitekey: yandexClientKey,
                hl: 'ru'
            });
        } else {
            setTimeout(initCaptcha, 1000);
        }
    }

    //обрабатываем отправку формы
	form.addEventListener("submit", (event) => {
		event.preventDefault();

		if (!formValidate(form)) {
			alert("Заполните обязательные поля");
			return;
		}

		mask.classList.add("active");
		// Создаем объект FormData
		const formData = new FormData(form);

		formData.append("action", "send_review"); // Указываем действие для WordPress
        formData.append("nonce", "<?php echo wp_create_nonce('review_nonce'); ?>"); // Добавляем nonce


		// Если файл выбран, добавляем его в FormData
		if (fileInput.files.length > 0) {
			formData.append("image", fileInput.files[0]);
		}

		// Отправляем данные на сервер
		fetch(ajax_object.send_review_url, {
			method: "POST",
			body: formData, // Отправляем FormData
		})
			.then((response) => {
				if (!response.ok) {
					throw new Error("Network response was not ok");
				}
				return response.json();
			})
			.then((data) => {
				console.log("Success:", data);

				if (modal && typeof modal.close === "function") {
					modal.close();
				}

				alert("Ваш отзыв успешно отправлен!");
				form.reset();
				mask.classList.remove("active");
				 document.body.classList.remove("no-scroll");
			})
			.catch((error) => {
				console.error("Error:", error);
				alert("Произошла ошибка при отправке отзыва.");
				mask.classList.remove("active");
				 document.body.classList.remove("no-scroll");
			});
	});


	// Обработчик для загрузки файла
    fileInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                //создаем миниатюру
                filePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                filePreview.style.display = "block";
            };
            reader.readAsDataURL(file);
        } else {
            alert("Пожалуйста, выберите изображение.");
            fileInput.value = ""; // Очищаем поле выбора файла
        }
    });


	// Функция для очистки миниатюры
function clearPreview() {
    filePreview.innerHTML = ""; // Очищаем миниатюру
    filePreview.style.display = "none"; // Скрываем блок миниатюры
}

// Обработчик события reset для формы
form.addEventListener("reset", function (event) {
    clearPreview(); // Очищаем миниатюру при сбросе формы
});

// Обработчик клика на кнопке очистки формы
clearFormBtn.addEventListener("click", function () {
    form.reset(); // Сбрасываем форму
});

});