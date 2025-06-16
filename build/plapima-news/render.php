<?php

$actusAccueil = new WP_Query([
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 4,
]);
if ($actusAccueil->have_posts()):
	$i = 1;
	?>
	<div class="actus-home bg-primary-40 rounded pt-md-6 p-4">
		<h2 class="mb-md-5 mb-4">Actualités</h2>
		<div class="d-flex flex-md-row flex-column mt-4 flex-wrap">
			<?php
			while ($actusAccueil->have_posts()):
				$actusAccueil->the_post();

				if ($i == 1) {
					?>
					<div class="first-news bg-white rounded news col-md-5 col-12 p-3">

						<div class="image rounded">
							<a href="<?php echo get_the_permalink(); ?>">
								<?php
								$size = wp_is_mobile() ? 'medium' : 'large';

								if (has_post_thumbnail()) {
									the_post_thumbnail($size, ['class' => 'rounded']);
								} else {
									$img = getBasicImage('2025/06', 'img-bis-actus.png', $size);
									echo '<img class="rounded wp-post-image" src="' . $img['src'] . '" alt="'
										. $img['src'] . '">';
								}
								?>
							</a>
						</div>
						<div class="content">
							<h3 class="mt-5">
								<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
							</h3>

							<div class="date mb-4">
								<?php echo get_the_date(); ?>
							</div>
							<p><?php echo createNewsExcerpt(300, get_the_content(true, true)); ?></p>
							<div class="bottom-link mt-3">
								<a href="<?php echo get_permalink(); ?>">Lire la suite</a>
							</div>
						</div>
					</div>
					<?php
				} else {
					if ($i == 2):
						?>
						<div class="news-list d-flex flex-column col-md-7 col-12 ps-md-5">
					<?php
					endif;
					?>
					<div class="news rounded bg-white p-3 d-flex flex-md-row flex-column mb-4 mt-md-0 <?php echo $i == 2
						? 'mt-4' : ''; ?> ">

						<div class="col-md-4 d-flex">
							<div class="image rounded">
								<a href="<?php echo get_the_permalink(); ?>">
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
								</a>
							</div>
						</div>
						<div class="content ps-md-4 mt-md-0 mt-3">
							<h3>
								<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
							</h3>
							<div class="date">
								<?php echo get_the_date(); ?>
							</div>
							<p><?php echo createNewsExcerpt(60, get_the_content(true, true)); ?></p>
							<div class="bottom-link d-flex justify-content-end">
								<a href="<?php echo get_permalink(); ?>">Lire la suite</a>
							</div>
						</div>
					</div>

					<?php
				}
				if ($i === $actusAccueil->post_count):
					?>
					</div>
				<?php
				endif;
				$i++;
			endwhile;
			wp_reset_postdata();
			?>
			<div class="link col-12 py-md-5-5 py-3">
				<a href="<?php echo get_permalink(ACTUALITES); ?>">Découvrez toutes les actualités</a>
			</div>
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
