<?php if (!defined('ABSPATH')) exit; ?>

<section class='separator '>
	<div class="container separator__inner">
		<h2 class="separator__title"><?php the_field('separator_text-fpart'); ?> <span><?php the_field('separator_text-spart'); ?></span></h2>
		<button type="button" id="present-showModal-btn" class="btn-link btn-link_dark"><?php the_field('separator_btn'); ?></button>
	</div>
</section>