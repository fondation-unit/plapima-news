<?php

$actusAccueil = new WP_Query([
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 4,
]);
if ($actusAccueil->have_posts()):
	?>
	<div class="actus-home pt-md-6 p-4">
		<div class="d-flex flex-md-row flex-column justify-content-between titre-formations-home align-items-end mb-4">
			<h2 class="mb-md-5 mb-4">Actualités</h2>
			<a class="btn" href="<?php echo get_permalink(ACTUALITES); ?>">Découvrez toutes les actualités</a>
		</div>
		<div class="d-flex flex-md-row flex-column mt-4">
			<?php
			while ($actusAccueil->have_posts()):$actusAccueil->the_post();
				?>
				<a href="<?php echo get_permalink(); ?>" class="news flex-column bg-white d-flex">
					<div class="image">
						<?php
						$size = wp_is_mobile() ? 'medium' : 'medium_large';
						if (has_post_thumbnail()) {
							the_post_thumbnail($size, ['class' => 'rounded']);
						} else {
							$img = getBasicImage('2025/06', 'img-bis-actus.png', $size);
							echo '<img class="rounded wp-post-image" src="' . $img['src'] . '" alt="'
								. $img['src'] . '">';
						}
						?>
					</div>
					<div class="content mt-md-0 mt-3">
						<h3>
							<?php echo get_the_title(); ?>
						</h3>
						<hr>
						<p><?php echo createNewsExcerpt(60, get_the_content(true, true)); ?></p>
						<div class="date mt-md-5 mt-4">
							<?php echo get_the_date(); ?>
						</div>

					</div>
				</a>
			<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
<?php
else:
	?>
	<div class="actus-home bg-primary-40 rounded py-md-6 p-4">
		<h2 class="mb-md-5 mb-4">Actualités</h2>
		<div class="d-flex flex-md-row flex-column mt-4 flex-wrap">
			<p>Retrouvez bientôt ici les actualités de PLAPIMA !!</p>
		</div>
	</div>
<?php
endif;
