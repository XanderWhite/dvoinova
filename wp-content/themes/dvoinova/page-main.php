<?php
/*
Template Name: шаблон главной
*/
?>

<?php get_header(); ?>

<main class="main" id="home">
	<?php get_template_part('template-parts/blocks/home/intro'); ?>
	<?php get_template_part('template-parts/blocks/home/services'); ?>
	<?php get_template_part('template-parts/blocks/home/how'); ?>
	<?php get_template_part('template-parts/blocks/home/separator'); ?>
	<?php get_template_part('template-parts/blocks/home/gallery'); ?>
	<?php get_template_part('template-parts/blocks/home/reviews'); ?>
</main>

<?php get_footer(); ?>