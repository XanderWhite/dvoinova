<?php
/*
Template Name: шаблон главной
*/
?>

<?php get_header(); ?>

<main class="main" id="home">
	<?php get_template_part('template-parts/blocks/intro-section'); ?>
	<?php get_template_part('template-parts/blocks/services-section'); ?>
	<?php get_template_part('template-parts/blocks/how-section'); ?>
	<?php get_template_part('template-parts/blocks/separator-section'); ?>
	<?php get_template_part('template-parts/blocks/gallery-section'); ?>
	<?php get_template_part('template-parts/blocks/reviews-section'); ?>
</main>

<?php get_footer(); ?>