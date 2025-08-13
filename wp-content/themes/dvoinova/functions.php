<?php
/**
 * solution6 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package solution6
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function solution6_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on solution6, use a find and replace
		* to change 'solution6' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'solution6', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'solution6' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'solution6_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'solution6_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function solution6_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'solution6_content_width', 640 );
}
add_action( 'after_setup_theme', 'solution6_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function solution6_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'solution6' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'solution6' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'solution6_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
// function solution6_scripts() {
// 	wp_enqueue_style( 'solution6-style', get_stylesheet_uri(), array(), _S_VERSION );
// 	wp_style_add_data( 'solution6-style', 'rtl', 'replace' );

// 	wp_enqueue_script( 'solution6-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

// 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 		wp_enqueue_script( 'comment-reply' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'solution6_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



//----------------------------------------------------------
//Создаем пункт меню опций в боковом меню wp

if (function_exists("acf_add_options_page")) {
    acf_add_options_page(array(
        "page_title" => "Параметры сайта",
        "menu_title" => "Параметры сайта",
        "menu_slug"  => "theme_settings",
    ));
}

//----------------------------------------------------------
//подключаем мой js и css


add_action('wp_enqueue_scripts', 'my_scripts');
// add_action('wp_enqueue_styles', 'my_styles');


function my_styles() {
}

function my_scripts() {
    //========================================================
    //CSS
    wp_enqueue_style( 'main-theme', get_stylesheet_uri() ); // это для подключения файла стиле из темы style.css из корня. оставляем как дань традиции
    
    // Подключение стилей Slick Slider
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/slick/slick.css' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/slick/slick-theme.css' );
	
	 // Подключение стилей Swiper
    wp_enqueue_style( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.css' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array('slick','slick-theme','swiper') );
    
    //========================================================
    //JS
    // wp_deregister_script( 'jquery' );//отключение собственной библиотеки wordpress
    wp_enqueue_script('jquery');
     
       wp_enqueue_script(
        'script', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/script.js',
        null,
        null,
        true
    );
    
       wp_enqueue_script(
        'cursor', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/cursor.js',
        null,
        null,
        true
    );
    
       wp_enqueue_script(
        'header', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/header.js',
        null,
        null,
        true
    );
    
       wp_enqueue_script(
        'services', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/services.js',
        null,
        null,
        true
    );
      
        // Подключаем библиотеку panzoom для zoom картинок
    wp_enqueue_script('panzoom', 'https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js', array(), '4.5.1', true);
    
    // wp_enqueue_script(
    //     'gallery', // Уникальное имя для вашего скрипта
    //     get_template_directory_uri() . '/js/gallery.js', 
    //     array('jquery'), 
    //     null,
    //     true 
    // );
    
    // Подключение gallery.js с зависимостью от jQuery
    wp_enqueue_script(
        'gallery',
        get_template_directory_uri() . '/js/gallery.js',
        array('jquery', 'panzoom'),
        null,
        true
    );
    
       wp_enqueue_script(
        'footer', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/footer.js',
        null,
        null,
        true
    );
    
       wp_enqueue_script(
        'scroll-animation', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/scroll-animation.js', null,null,true
    );
    
      wp_enqueue_script(
        'modal', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/modal.js',
        null,
        null,
        true
    );
      
          wp_enqueue_script(
        'review-modal', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/review-modal.js',
        null,
        null,
        true
    );
    
       wp_enqueue_script(
        'present-modal', // Уникальное имя для вашего скрипта
        get_template_directory_uri() . '/js/present-modal.js',
        null,
        null,
        true
    );
    //   wp_enqueue_script(
    //     'privacy-modal', // Уникальное имя для вашего скрипта
    //     get_template_directory_uri() . '/js/privacy-modal.js',
    //     null,
    //     null,
    //     true
    // );
    

    wp_localize_script('gallery', 'ajax_object', array(
    'get_images_url' => admin_url('admin-ajax.php?action=get_images'),    // URL для AJAX-запроса
    'is_home' => (is_front_page() || is_home()),
    'send_review_url' => admin_url('admin-ajax.php?action=send_review'),
    'send_present_url' => admin_url('admin-ajax.php?action=send_present'),
    'ajax_url' => admin_url('admin-ajax.php'),
     'nonce' => wp_create_nonce('load_more_gallery_nonce') // Добавляем nonce
    ));
   

    wp_enqueue_script(
        'jquery-cdn', 
        'https://code.jquery.com/jquery-1.11.0.min.js', // Ссылка на jQuery
        array(), // Пустой массив зависимостей, так как загружается из CDN
        null, // Версия скрипта
        true // Загружать внизу страницы
    );

    // Подключение jQuery Migrate из CDN
    wp_enqueue_script(
        'jquery-migrate-cdn',
        'https://code.jquery.com/jquery-migrate-1.2.1.min.js',
        array('jquery-cdn'), // Зависит от jQuery
        null,
        true
    );

    // Подключение Slick Slider
    wp_enqueue_script(
        'slick-slider',
        get_template_directory_uri() . '/slick/slick.min.js',
        array('jquery-cdn'), // Зависит от jQuery
        null,
        true
    );

    wp_enqueue_script(
        'slider-js',
        get_template_directory_uri() . '/js/slider.js',
      null,
        null,
        true
    );
    
    // Подключение JavaScript Swiper
    wp_enqueue_script( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true );

    // Подключение кастомного скрипта (reviews.js)
    wp_enqueue_script( 'reviews', get_template_directory_uri() . '/js/reviews.js', array('swiper'), null, true );
    
   }




//-----------------------------------------------------
//удаляем полоску admina над сайтом

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
        show_admin_bar(false);
    if (!current_user_can('administrator')) {
    }
}


//------------------------------------------------------
//отключаем стили css темы


function deregister_styles() {
    wp_deregister_style('plugin-style'); // Укажите идентификатор стиля
}

add_action('wp_print_styles', 'deregister_styles', 100);


//------------------------------------------------------
//подгружаем картинки


add_action('wp_ajax_get_images', 'get_images');
add_action('wp_ajax_nopriv_get_images', 'get_images');

function get_images() {
    header('Content-Type: application/json');

    $directory = get_template_directory() . '/images/gallery';
    $images = glob($directory . "/*.{jpg,jpeg,png,gif,webp,JPG}", GLOB_BRACE);

    usort($images, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });

    $newimages = array_map(function($image) {
        return get_template_directory_uri() . '/images/gallery/' . basename($image);
    }, $images);

    echo json_encode($newimages);
    wp_die(); // Завершите выполнение скрипта корректно
}

//--------------------------------------------------------
// Настраиваем отправку почты

// Обработчик для AJAX-запросов для Заказа подарка

add_action('wp_ajax_send_present', 'handle_present_submission'); // Для авторизованных пользователей
add_action('wp_ajax_nopriv_send_present', 'handle_present_submission'); // Для неавторизованных пользователей

function handle_present_submission() {
    header('Content-Type: application/json');

    // Проверяем, что данные формы отправлены
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        // Получаем данные из формы
        $present = sanitize_text_field($_POST['present-radio'] ?? '');
        $date = sanitize_text_field($_POST['date'] ?? '');
        $name = sanitize_text_field($_POST['name'] ?? '');
        $phone = sanitize_text_field($_POST['phone'] ?? '');

        // Проверяем, что обязательные поля заполнены
        if (empty($present) || empty($name) || empty($phone)) {
            echo json_encode(['error' => 'Неверные данные']);
            exit;
        }

        // Настройки для отправки почты
        $to = 'xander.belov23@yandex.ru';
        $subject = 'Запрос на подарок: ' . $present;
        $message = "Подарок: $present\n";
        $message .= "Дата: $date\n";
        $message .= "Имя: $name\n";
        $message .= "Номер телефона: $phone\n";

        // Заголовки
        $headers = 'From: xander.belov23@yandex.ru' . "\r\n" .
        'Reply-To: xander.belov23@yandex.ru' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        $body = $message;

        // Отправляем email
        if (mail($to, $subject, $body, $headers)) {
            echo json_encode(['message' => 'Запрос на подарок успешно отправлен']);
        } else {
            echo json_encode(['error' => 'Не удалось отправить запрос на подарок']);
        }
    } else {
        echo json_encode(['error' => 'Неверные данные']);
    }


    wp_die();
}


// Обработчик для AJAX-запросов для Отзывов

add_action('wp_ajax_send_review', 'handle_review_submission'); // Для авторизованных пользователей
add_action('wp_ajax_nopriv_send_review', 'handle_review_submission'); // Для неавторизованных пользователей

function handle_review_submission() {
    // Ваш код из modal-review.php
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = sanitize_text_field($_POST['event'] ?? '');
        $author = sanitize_text_field($_POST['author'] ?? '');
        $text = sanitize_textarea_field($_POST['review'] ?? '');
        $image = $_FILES['image'] ?? null;

        if (empty($title) || empty($author) || empty($text)) {
            echo json_encode(['error' => 'Неверные данные']);
            wp_die();
        }

        $to = 'xander.belov23@yandex.ru';
        $subject = 'Новый отзыв: ' . $title;
        $message = "Название события: $title\n";
        $message .= "Автор: $author\n";
        $message .= "Отзыв: $text\n";

        $headers = 'From: xander.belov23@yandex.ru' . "\r\n" .
                   'Reply-To: xander.belov23@yandex.ru' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $filePath = $image['tmp_name'];
            $fileName = $image['name'];
            $fileType = $image['type'];

            $fileContent = file_get_contents($filePath);
            $fileContent = chunk_split(base64_encode($fileContent));

            $boundary = md5(time());

            $headers .= "\r\nMIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

            $body = "--$boundary\r\n";
            $body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
            $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $body .= $message . "\r\n\r\n";
            $body .= "--$boundary\r\n";
            $body .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n";
            $body .= $fileContent . "\r\n\r\n";
            $body .= "--$boundary--\r\n";
        } else {
            $body = $message;
        }

        if (mail($to, $subject, $body, $headers)) {
            echo json_encode(['message' => 'Отзыв успешно отправлен']);
        } else {
            echo json_encode(['error' => 'Не удалось отправить отзыв']);
        }
    } else {
        echo json_encode(['error' => 'Неверные данные']);
    }

    wp_die();
}

//===================================================================
// Подгрузка изображений из галереи WP

add_action('wp_ajax_dvoinova_load_more_gallery', 'dvoinova_load_more_gallery_handler');
add_action('wp_ajax_nopriv_dvoinova_load_more_gallery', 'dvoinova_load_more_gallery_handler');

function dvoinova_load_more_gallery_handler() {
    try {
        // Проверка nonce
        if (!check_ajax_referer('load_more_gallery_nonce', 'nonce', false)) {
            wp_send_json_error(['message' => 'Nonce verification failed']);
            return;
        }

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $images_per_page = 24;
        $offset = ($page - 1) * $images_per_page;

        $global_gallery = get_field('global_gallery', 'option') ?: [];
        $reversed_gallery = array_reverse($global_gallery);
        $current_images = array_slice($reversed_gallery, $offset, $images_per_page);

        $html = '';
        foreach ($current_images as $img) {
            if (!empty($img)) {
                $html .= sprintf(
                    '<img class="photo-img" src="%s" alt="%s" data-full-url="%s">',
                    esc_url($img['sizes']['large']),
                    esc_attr($img['alt']),
                    esc_url($img['url'])
                );
            }
        }

        $total_images = count($reversed_gallery);
        $has_more = $total_images > $page * $images_per_page;

        wp_send_json_success([
            'html' => $html,
            'next_page' => $has_more ? $page + 1 : $page,
            'has_more' => $has_more
        ]);

    } catch (Exception $e) {
        wp_send_json_error(['message' => $e->getMessage()]);
    }
}