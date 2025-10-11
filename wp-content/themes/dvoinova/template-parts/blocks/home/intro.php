<?php if (!defined('ABSPATH')) exit; ?>

<section class='intro'>
	<div class="intro-left">
		<div class="intro__block slider-intro">
			<?php if (get_field('intro_slider')): ?>
				<?php while (has_sub_field('intro_slider')) :?>
					<?php
						$image_desktop = get_sub_field('intro_slider_image');
						$image_tablet = get_sub_field('intro_slider_image-tablet');
						$image_mobile = get_sub_field('intro_slider_image-mobile');
					?>
					<div class="slider-item">
						<picture>
							<?php if ($image_mobile): ?>
								<source media="(max-width: 539px), (min-width: 1024px) and (max-width: 1279px)" srcset="<?= $image_mobile; ?>">
							<?php endif; ?>
							<?php if ($image_tablet): ?>
								<source media="(max-width: 1023px)" srcset="<?= $image_tablet; ?>">
							<?php endif; ?>
							<img class="slider-img" src="<?= $image_desktop; ?>" alt="">
						</picture>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="intro__content">
		<div class="intro__content__container">
			<h2 class="intro__title"><?php the_field('intro_title_up'); ?> <span class="intro__title__span "><?php the_field('intro_title_down'); ?></span></h2>
			<p class="intro__text"><?php the_field('intro_text'); ?></p>
			<a href="tel:+79606185537" class="intro__btn btn-link btn-link_pink-hover-light"><?php the_field('intro_btn'); ?></a>
		</div>
	</div>
</section>