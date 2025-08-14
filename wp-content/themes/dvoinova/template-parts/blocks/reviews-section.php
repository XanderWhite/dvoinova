<?php if (!defined('ABSPATH')) exit; ?>

<section class='reviews' id="reviews">
	<div class="reviews__inner container">
		<h2 class="title">
			<?php the_field('reviews_title'); ?>
		</h2>
		<div class="swiper-container">
			<div class="reviews__block swiper-wrapper">
				<?php if (get_field('review_list')): ?>
					<?php while (has_sub_field('review_list')) : ?>
						<?php if (have_rows('review')): ?>
							<?php while (have_rows('review')): the_row(); ?>
								<article class="review swiper-slide">
									<img class='reviews-pic' src='<?php the_sub_field('review_image'); ?>' alt=''>
									<div class="review__titles">
										<h3 class="review__title"> <?php the_sub_field('review_event'); ?></h3>
										<h4 class="review__subtitle"><?php the_sub_field('review_name'); ?></h4>
									</div>
									<p class="review__text"><?php the_sub_field('review_text'); ?></p>
								</article>
							<?php endwhile; ?>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div class="reviews__swiper-buttons">
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		</div>
		<button type="button" id="review-showModal-btn" class=" btn-link btn-link_pink-hover-dark">Оставить отзыв</button>
	</div>
</section>