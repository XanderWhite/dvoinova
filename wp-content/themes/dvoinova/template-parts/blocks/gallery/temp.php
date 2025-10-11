	<h2 class="title">Галерея</h2>







		<?php
		$photos_per_page = 24;
		$page = max(1, get_query_var('paged', 1));
		$global_photos = get_field('gallery_photos') ?: [];
		$total_photos = count($global_photos);
		$reversed_photos = array_reverse($global_photos);
		$current_photos = array_slice($reversed_photos, ($page - 1) * $photos_per_page, $photos_per_page);
		?>

		<div class="photos__container" id="photos-container" style="display: contents;">
			<div id="photosList">
				<?php foreach ($current_photos as $img): if ($img): ?>
						<img class="photo-img"
							src="<?php echo esc_url($img['sizes']['large']); ?>"
							alt="<?php echo esc_attr($img['alt']); ?>"
							data-full-url="<?php echo esc_url($img['url']); ?>">
				<?php endif;
				endforeach; ?>
			</div>

			<?php if ($total_photos > $page * $photos_per_page): ?>
				<div class="load-more-wrapper">
					<button class="load-more-btn btn-link btn-link_pink-hover-dark"
						data-page="<?php echo $page + 1; ?>"
						data-nonce="<?php echo wp_create_nonce('load_more_photos_nonce'); ?>">
						Показать еще
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
			</div>