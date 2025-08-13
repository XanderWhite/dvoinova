<?php 
/*
Template Name: шаблон галереи
*/
?>

<?php 
set_query_var('page_class', 'page__inner_gallery');
get_header();
?>

<main class="main">
    <section class='gallery gallery_page-gallery'>
        <div class="gallery__inner container ">
            <h2 class="title"><?php the_field('gallery_title'); ?></h2>
            <?php
            $images_per_page = 24;
            $page = max(1, get_query_var('paged', 1));
            $global_gallery = get_field('global_gallery', 'option') ?: [];
            $total_images = count($global_gallery);
            $reversed_gallery = array_reverse($global_gallery);
            $current_images = array_slice($reversed_gallery, ($page-1)*$images_per_page, $images_per_page);
            ?>
            
            <div class="gallery-container" id="gallery-container" style="display: contents;">
                <div id="photo">
                    <?php foreach ($current_images as $img): if ($img): ?>
                        <img class="photo-img"
                             src="<?php echo esc_url($img['sizes']['large']); ?>"
                             alt="<?php echo esc_attr($img['alt']); ?>"
                             data-full-url="<?php echo esc_url($img['url']); ?>"
                            >
                    <?php endif; endforeach; ?>
                </div> 
            
                <?php if ($total_images > $page*$images_per_page): ?>
                <div class="load-more-wrapper">
                    <button class="load-more-btn btn-link btn-link_pink-hover-dark"
                            data-page="<?php echo $page+1; ?>"
                            data-nonce="<?php echo wp_create_nonce('load_more_gallery_nonce'); ?>">
                        Показать еще
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>