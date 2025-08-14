<dialog id="review-modal" class="modal">
	<div class="modal__dialog">
		<span id="review-modal__close-btn" class="elem-close">
			<svg viewBox="0 0 32 32" class="elem-close__cross-svg">
				<line class="elem-close__cross-svg__line" x1="7" x2="25" y1="7" y2="25" />
				<line class="elem-close__cross-svg__line" x1="7" x2="25" y1="25" y2="7" />
			</svg>
		</span>
		<form class="modal__form" id="review-form">
			<h2 class="modal__title">Оставьте свой отзыв</h2>
			<label class="modal__form__lbl">
				Ваше имя
				<input class="modal__form__input req" type="text" id="author-input" name="author">
			</label>
			<label class="modal__form__lbl">
				Название события
				<input class="modal__form__input req" type="text" id="event-input" name="event">
			</label>
			<label class="modal__form__lbl">
				Ваш отзыв
				<textarea class="modal__form__input modal__form__input_textarea req " id="review-input"
					name="review" maxlength="570"></textarea>
			</label>
			<label class="modal__form__lbl">
				Прикрепить фото
				<input type="file" id="review-file-input" accept="image/*" style="display: none;" name="image">
				<div id="review-file-preview" class="file-preview">
				</div>
			</label>
			<label class="modal__form__agreement">
				<input class="modal__form__agreement__checkbox req" id="formAgreement" type="checkbox" name="agreement" checked>
				<span class="modal__form__agreement__span"></span>
				<span> Я согласен(а) на публикацию отзыва и моего фото на сайте. Ознакомлен(а) с
					<a class="modal__form__agreement__link" target="_blank" href="/privacy">политикой обработки персональных данных</a>
				</span>
			</label>
			<div class="modal__form__buttons">
				<button type="button" id="review-clear-form-btn" class="clear-form-btn btn-link btn-link_pink-hover-light">Очистить форму</button>
				<button class="btn-link btn-link_pink-hover-light" id="review-submit-btn"
					type="submit">Отправить</button>
			</div>
		</form>
	</div>
	<div class="mask">
		<div class="mask__loader"></div>
	</div>
</dialog>