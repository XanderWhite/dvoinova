<?php if (!defined('ABSPATH')) exit; ?>

<section class='gallery'>
	<div class="container gallery__inner">
		<h2 class="title"><?php the_field('gallery_title'); ?></h2>
		<div class="gallery__photos">
			<?php
			if ($img_gallery = get_field('photos')) :
				$images = array_slice($img_gallery, -9); // Получаем последние 9 изображений
				$images = array_reverse($images);
				foreach ($images as $img) :
					if ($img) :
						echo "<img class='photo-img' src='" . esc_url($img['sizes']['large']) . "' alt='" . esc_attr($img['alt']) . "' data-full-url='" . esc_url($img['url']) . "' />";
					endif;
				endforeach;
			endif;
			?>
		</div>
		<a href="<?= esc_url(get_permalink(14)); ?>" class=" btn-link btn-link_pink-hover-dark" id="more_photo"><?php the_field('gallery_btn'); ?></a>
	</div>
</section>