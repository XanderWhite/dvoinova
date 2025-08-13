<?php 
/*
Template Name: шаблон главной
*/
?>

<?php get_header(); ?>
   
                  <main class="main" id="home">


            <!-- Intro -->
            <section class='intro'>
                <div class="intro-left">

                    <div class="intro__block slider-intro">


<?php if(get_field('intro_slider')): ?>
<?php while(has_sub_field('intro_slider')) : ?>
   <div class="slider-item">
      <img class="slider-img" src="<?php the_sub_field('intro_slider_image'); ?>"  alt=''>
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
                            </section> <!-- /intro -->

            <section class="services container" id="services">
                <h2 class="title"><?php the_field('services-block_title'); ?></h2>
               
                <div class="services__content">

<?php if(get_field('services')): ?>
<?php while(has_sub_field('services')) : ?>
   
   <?php if( have_rows('service') ): ?>
<?php while( have_rows('service') ): the_row(); ?>

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
                                    <?php if(get_sub_field('service_list')): ?>
                                        <?php while(has_sub_field('service_list')) : ?>
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

            </section><!-- /services -->


            <!-- how -->
            <section class='how container'>
                <h2 class="title"><?php the_field('skills_title'); ?></h2>

                <div class="how__content">

<?php if(get_field('skill')): ?>
<?php while(has_sub_field('skill')) : ?>
   
   <?php if( have_rows('skill_row') ): ?>
<?php while( have_rows('skill_row') ): the_row(); ?>

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
            </section> <!-- /how -->

            <!-- Separator -->
            <section class='separator '>
                <div class="container separator__inner">
                    <h2 class="separator__title"><?php the_field('separator_text-fpart'); ?> <span><?php the_field('separator_text-spart'); ?></span></h2>
                  
                  
                      <button type="button" id="present-showModal-btn" class="btn-link btn-link_dark"><?php the_field('separator_btn'); ?></button>

                </div>
            </section> <!-- /separator -->
            <!-- Gallery -->
            <section class='gallery'>
                <div class="container gallery__inner">
                    <h2 class="title"><?php the_field('gallery_title'); ?></h2>
                    <div id="photo">
                        <?php
                            if ($img_gallery = get_field('global_gallery', 'option')) : 
                                $images = array_slice($img_gallery, -9); // Получаем последние 9 изображений
                                $images = array_reverse($images);
                                foreach ($images as $img) :
                                    if ($img) :
                                        echo "<img 
                                        class='" ."photo-img". "'
                                        src='" . esc_url($img['sizes']['large']) . "' 
                                        alt='" . esc_attr($img['alt']) . "'
                                        data-full-url='" . esc_url($img['url']) . "'
                                        />";
                                    endif;
                                endforeach;
                            endif;
                        ?>
                    </div>
                     <a href="<?= esc_url(get_permalink(14)); ?>" class=" btn-link btn-link_pink-hover-dark" id="more_photo"><?php the_field('gallery_btn'); ?></a>
                </div>
            </section> <!-- /gallery -->

            <!-- Reviews -->
            <section class='reviews' id="reviews">
                <div class="reviews__inner container">
                    <h2 class="title">
                        <?php the_field('reviews_title'); ?>
                    </h2>
                    <div class="swiper-container">
                        <div class="reviews__block swiper-wrapper">
                            <?php if(get_field('review_list')): ?>
                                <?php while(has_sub_field('review_list')) : ?>
   
                                    <?php if( have_rows('review') ): ?>
                                        <?php while( have_rows('review') ): the_row(); ?>

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
                        </div> <!-- /reviews__block swiper-wrapper -->

                        <div class="reviews__swiper-buttons">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div> <!-- /swiper-container -->

                    <button type="button" id="review-showModal-btn" class=" btn-link btn-link_pink-hover-dark">Оставить отзыв</button>
                </div>
            </section> <!-- /reviews -->
        </main>


    
    
<?php get_footer(); ?>