<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package solution6
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); print_r('here') ?>>
	<div class="page__inner <?php echo get_query_var('page_class'); ?>">
		<h1 class="visually-hidden">Ведущий</h1>
		<header class="header" id="header">
			<div class="container header__inner">
				<h2 class="header__logo"><?php the_field("company_name", "option"); ?><span class="header__logo__span"><?php the_field("slogan", "option"); ?></span></h2>
				<nav class="nav" id="nav">
					<ul class="menu">
						<?php if (get_field('menu', 'options')): ?>
							<?php while (has_sub_field('menu', 'options')) : ?>
								<li class="menu__item">
									<a class="menu__link " href="<?php the_sub_field('menu_link'); ?>"><?php the_sub_field('menu_name'); ?></a>
								</li>
							<?php endwhile; ?>
						<?php endif; ?>
					</ul>
				</nav>
				<button class="btn-menu">
					<span class="btn-menu__line"></span>
				</button>
			</div>
		</header>