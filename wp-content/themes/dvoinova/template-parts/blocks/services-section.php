<?php if (!defined('ABSPATH')) exit; ?>

<section class="services container" id="services">
	<h2 class="title"><?php the_field('services-block_title'); ?></h2>
	<div class="services__content">
		<?php if (get_field('services')): ?>
			<?php while (has_sub_field('services')) : ?>
				<?php if (have_rows('service')): ?>
					<?php while (have_rows('service')): the_row(); ?>
						<article class="service">
							<div class="service__inner">
								<div class="service__front">
									<img class='service__pic' src='<?php the_sub_field('service_image'); ?>' alt=''>
									<div class="service__content">
										<h3 class="service__title">
											<?php the_sub_field('service_title'); ?>
										</h3>
										<span class="service__price">
											<?php the_sub_field('service_price'); ?>
										</span>
										<p class="service__text">
											<?php the_sub_field('service_text'); ?>
										</p>
									</div>
								</div>
								<div class="service__back">
									<ul class="service__list">
										<?php if (get_sub_field('service_list')): ?>
											<?php while (has_sub_field('service_list')) : ?>
												<li class='service__item'><?php the_sub_field('service_list_item'); ?></li>
											<?php endwhile; ?>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>