<?php
/*
Template Name: шаблон галереи
*/
?>

<?php
set_query_var('page_class', 'page__inner_gallery');
get_header();
?>

<main class="main">
	<div class="gallery">
		<div class="gallery__tabs container">
				<button class="gallery__tab " data-tab="photo">Фото</button>
				<button class="gallery__tab" data-tab="video">Видео</button>
				<button class="gallery__tab active" data-tab="video">Видео</button>
				<button class="gallery__tab" data-tab="video">Видео</button>
				<button class="gallery__tab" data-tab="video">Видео</button>
			</div>

		<?php get_template_part('template-parts/blocks/gallery/photos'); ?>
		<?php get_template_part('template-parts/blocks/gallery/videos'); ?>
	</div>
</main>

<?php get_footer(); ?>