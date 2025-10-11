<div class='photos'>
	<div class="photos__inner container">
		<?php
		$photos_groups = get_field('photos_group');
		if ($photos_groups):
			foreach (array_reverse($photos_groups) as $group): ?>
				<div class="photos__group">
					<?php
					$title = $group['photos_group-title'];
					if ($title): ?>
						<h3 class="photos__group-title c-title-small">
							<?= $title; ?>
						</h3>
					<?php endif; ?>

					<?php $photos = $group['photos']; ?>

					<?php if ($photos): ?>
						<div class="photos__list">
							<?php foreach ($photos as $img): ?>
								<?php if ($img): ?>
									<img class="photo-img"
										src="<?php echo esc_url($img['sizes']['large']); ?>"
										alt="<?php echo esc_attr($img['alt']); ?>"
										data-full-url="<?php echo esc_url($img['url']); ?>">
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>