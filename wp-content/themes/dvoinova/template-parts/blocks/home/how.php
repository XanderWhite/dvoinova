<?php if (!defined('ABSPATH')) exit; ?>

<section class='how container'>
	<h2 class="title"><?php the_field('skills_title'); ?></h2>
	<div class="how__content">
		<?php if (get_field('skill')): ?>
			<?php while (has_sub_field('skill')) : ?>
				<?php if (have_rows('skill_row')): ?>
					<?php while (have_rows('skill_row')): the_row(); ?>

						<div class="how__row">
							<span class="how__item">
								<?php the_sub_field('skill_row_text-f'); ?>
							</span>
							<span class="how__item">
								<?php the_sub_field('skill_row_text-s'); ?> </span>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>