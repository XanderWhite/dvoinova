const modalGallery = document.getElementById("modal-gallery");
const modalContent = document.getElementById("modal-content");
const closeButton = document.getElementById("modal-gallery__close-btn");
let currentSlide = 0;


// Обработчик закрытия модального окна (на случай других способов закрытия)
    modalGallery.addEventListener('close', closeModal);

// Функция для закрытия модального окна
function closeModal() {
    // Удаляем картинки из модального слайдера
    modalContent.innerHTML = '';

    // Удаляем слайдер
    if ($(".slider-modal").hasClass("slick-initialized")) {
        $(".slider-modal").slick("unslick");
    }

    modalGallery.close();
    document.body.classList.remove("no-scroll");
}

function initGallery() {
    // const photo = document.getElementById('photo');
    const images = document.querySelectorAll('.photo-img');

    if (!images) return;

    images.forEach((image, index)=> {
        image.addEventListener('click', () => {

        document.body.classList.add("no-scroll");
        modalGallery.showModal();

        // Добавляем запись в историю браузера
        history.pushState({ modalOpen: true }, '');

        // Очищаем и перезаполняем модальное окно
        modalContent.innerHTML = '';
        images.forEach(img => {
            addImgToModalSlider(img.getAttribute('data-full-url'));
        });

        // Инициализируем слайдер
        if ($(".slider-modal").hasClass("slick-initialized")) {
            $(".slider-modal").slick("unslick");
        }

        $(".slider-modal").slick({
            infinite: true,
            fade: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: true,
            initialSlide: index,
            swipe: false,
            touchMove: false
        });

        // Переинициализируем Panzoom для новых изображений
        initPanzoom();
    });
    })
}

function addImgToModalSlider(src) {
    const img = document.createElement("img");
    img.src = src;
    img.alt = src;
    img.classList.add("slider-img");

    const divImage = document.createElement("div");
    divImage.classList.add("slider-item");
    divImage.classList.add("zoomable-image");
    divImage.appendChild(img);

    const divContainer = document.createElement("div");
    divContainer.classList.add("zoomable-image-container");
    divContainer.appendChild(divImage);

    modalContent.appendChild(divContainer);
}

// Обработчики закрытия модального окна
closeButton.addEventListener("click", closeModal);

// Обработчик кнопки "назад" в браузере
window.addEventListener('popstate', function(event) {
    if (modalGallery && modalGallery.open) {
        closeModal();
    }
});

// Закрытие по ESC
window.addEventListener("keydown", function (event) {
    if (event.key === "Escape" && modalGallery.open) {
        closeModal();
    }
});

// Инициализация Panzoom
function initPanzoom() {
    document.querySelectorAll('.zoomable-image').forEach(img => {
        const container = img.closest('.zoomable-image-container');
        const panzoom = Panzoom(img, {
            maxScale: 3,
            contain: 'outside',
            touchAction: 'none',
            startScale: 1
        });

        img.addEventListener('panzoomchange', (event) => {
            const { scale } = event.detail;
            if (scale === 1) {
                img.style.transform = 'translate(0, 0) scale(1)';
            }
        });

        container.addEventListener('wheel', (e) => {
            e.preventDefault();
            panzoom.zoomWithWheel(e);
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.zoomable-image')) {
                panzoom.reset();
            }
        });
    });
}

function initLoadMore() {
    jQuery(document).ready(function($) {
        $('body').on('click', '.load-more-btn', function(e) {
            e.preventDefault();

            var button = $(this);
            var container = $('#gallery-container #photo');

            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'dvoinova_load_more_gallery',
                    page: button.data('page'),
                    nonce: button.data('nonce')
                },
                beforeSend: function() {
                    button.text('Загрузка...').prop('disabled', true);
                },
                success: function(response) {
                    if(response.success) {
                        container.append(response.data.html);
                        button.data('page', response.data.next_page);

                        if(!response.data.has_more) {
                            button.parent().remove();
                        } else {
                            button.text('Показать еще').prop('disabled', false);
                        }
                    } else {
                        alert('Ошибка: ' + response.data.message);
                    }
                },
                error: function(xhr, status, error) {
                    button.text('Ошибка').prop('disabled', false);
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    initGallery();
    initPanzoom();
    initLoadMore();

    window.addEventListener("resize", () => {
        if ($(".slider-modal").hasClass("slick-initialized")) {
            currentSlide = $(".slider-modal").slick("slickCurrentSlide");
            $(".slider-modal").slick("unslick");

            $(".slider-modal").slick({
                infinite: true,
                fade: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true,
                initialSlide: currentSlide,
                swipe: false,
                touchMove: false
            });
        }
    });
});