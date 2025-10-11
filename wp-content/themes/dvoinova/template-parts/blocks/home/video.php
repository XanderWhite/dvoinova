<?php if (!defined('ABSPATH')) exit; ?>

<section class='video'>
	<div class="container video__inner">
		<h2 class="title"><?php the_field('videos_title'); ?></h2>
		<div id="video">
			<?php
			if ($videos = get_field('videos')) :
				foreach ($video as $video) :
					if ($video) :
						// echo "<img class='photo-img' src='" . esc_url($img['sizes']['large']) . "' alt='" . esc_attr($img['alt']) . "' data-full-url='" . esc_url($img['url']) . "' />";
					endif;
				endforeach;
			endif;
			?>
		</div>
		<a href="<?= esc_url(get_permalink(14)); ?>" class=" btn-link btn-link_pink-hover-dark" id="more_video"><?php the_field('videos_btn'); ?></a>
	</div>
</section>