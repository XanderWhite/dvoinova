<dialog id="present-modal" class="modal">
	<div class="modal__dialog">
		<span id="present-modal__close-btn" class="elem-close">
			<svg viewBox="0 0 32 32" class="elem-close__cross-svg">
				<line class="elem-close__cross-svg__line" x1="7" x2="25" y1="7" y2="25" />
				<line class="elem-close__cross-svg__line" x1="7" x2="25" y1="25" y2="7" />
			</svg>
		</span>
		<form class="modal__form" id="present-form">
			<h2 class="modal__title">Выберите подарок</h2>
			<div class="present">
				<label class="present__lbl">
					Видеоролик из ваших фото
					<input class="present__radio" type="radio" name="present-radio" value="Видеоролик из ваших фото">
					<span class="present__span"></span>
				</label>
				<label class="present__lbl">
					Помощь в организации мероприятия
					<input class="present__radio" type="radio" name="present-radio" value=" Помощь в организации мероприятия" checked>
					<span class="present__span"></span>
				</label>
				<label class="present__lbl">
					1 час работы диджея
					<input class="present__radio" type="radio" name="present-radio" value=" 1 час работы диджея">
					<span class="present__span"></span>
				</label>
			</div>
			<label class="modal__form__lbl">
				Укажите дату мероприятия
				<span class=" modal__form__lbl__subtext">Если не знаете дату, оставьте поле пустым</span>
				<input class="modal__form__input" type="date" name="date" id="date-input">
			</label>
			<label class="modal__form__lbl">
				Ваше имя
				<input class="modal__form__input req" type="text" name="name" id="name-input">
			</label>
			<label class="modal__form__lbl">
				Введите номер телефона
				<input class="modal__form__input req" id="phone-input" type="tel" name="phone"
					placeholder="8(999)999-99-99" maxlength="16" minlength="11">
			</label>
			<label class="modal__form__agreement modal__form__agreement_present">
				<input class="modal__form__agreement__checkbox req" id="formAgreement" type="checkbox" name="agreement">
				<span class="modal__form__agreement__span"></span>
				<span>
					Я принимаю условия
					<a class="modal__form__agreement__link" target="_blank" href="/privacy">политики конфиденциальности</a>
				</span>
			</label>
			<button class="btn-link btn-link_pink-hover-light" id="present-submit-btn" type="submit">Забронировать подарок</button>
			<div id="present-captcha-container"></div>
		</form>
	</div>
	<div class="mask">
		<div class="mask__loader"></div>
	</div>
</dialog>