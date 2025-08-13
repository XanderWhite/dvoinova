// Обработка Формы с Заказом подарка
document.addEventListener("DOMContentLoaded", function () {
	const showModalBtn = document.getElementById("present-showModal-btn");
	const modal = document.getElementById("present-modal");
	
	if (!showModalBtn || !modal) {
        return;
    }
	
	const modalCloseBtn = modal.querySelector("#present-modal__close-btn");
	const mask = modal.querySelector(".mask");
	const form = modal.querySelector("#present-form");
	
	  // Функция для закрытия модального окна
    function closeModal() {
        if (modal && typeof modal.close === "function") {
            modal.close();
        }
        document.body.classList.remove("no-scroll");
    }
	
// Обработчик закрытия модального окна (на случай других способов закрытия)
    modal.addEventListener('close', closeModal);
    
    
	window.addEventListener('popstate', function(event) {
   if (modal && modal.open) {
            closeModal();
        }
    
});

	//открываем модальное окно
	showModalBtn.addEventListener("click", () => {
		document.body.classList.add("no-scroll");
		modal.showModal();
		document.getElementById("name-input").focus();
		
		// Добавляем запись в историю браузера
    history.pushState({ modalOpen: true }, '');
	});

// Закрываем модальное окно по кнопке
    modalCloseBtn.addEventListener("click", () => {
        closeModal();
        if (history.state && history.state.modalOpen) {
            history.back();
        }
    });

	 //обрабатываем отправку формы
	form.addEventListener("submit", (event) => {
		event.preventDefault();

		if (!formValidate(form)) {
			alert("Заполните обязательные поля");
			return;
		}

		mask.classList.add("active");

		const formData = new FormData(form);
		
		formData.append("action", "send_present"); // Указываем действие для WordPress
        formData.append("nonce", "<?php echo wp_create_nonce('present_nonce'); ?>"); // Добавляем nonce


		// Отправляем данные на сервер
		fetch(ajax_object.send_present_url, {
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
});