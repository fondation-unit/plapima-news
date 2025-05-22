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
	<div class="container py-6">
		<h2>Actualités</h2>
		<div class="d-flex flex-md-row flex-column my-6">
			<?php
			while ($actusAccueil->have_posts()):
				$actusAccueil->the_post();

				if ($i == 1) {
					?>
					<div class="first-news news col-md-5 col-12 pe-4">
						<?php
						if (has_post_thumbnail()):
							?>
							<div class="image rounded">
								<?php
								the_post_thumbnail('large', ['class' => 'rounded']);
								?>
							</div>
						<?php
						endif;
						?>
						<div class="content">
							<h3 class="mt-5">
								<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
							</h3>

							<div class="date mb-4">
								<?php echo get_the_date(); ?>
							</div>
							<p><?php echo createNewsExcerpt(200, get_the_content(true, true)); ?></p>
							<div class="bottom-link">
								<a href="<?php echo get_permalink(); ?>">Lire la suite</a>
							</div>
						</div>
					</div>
					<?php
				} else {
					if ($i == 2):
						?>
						<div class="news-list d-flex flex-column col-md-7 col-12 ps-4">
					<?php
					endif;
					?>
					<div class="news d-flex flex-row mb-4">
						<?php
						if (has_post_thumbnail()):
							?>
							<div class="col-md-4 d-flex align-items-center">
								<div class="image rounded">
									<?php
									the_post_thumbnail('medium', ['class' => 'rounded']);
									?>
								</div>
							</div>
						<?php
						endif;
						?>
						<div class="content ps-4">
							<h3>
								<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
							</h3>
							<div class="date">
								<?php echo get_the_date(); ?>
							</div>
							<p><?php echo createNewsExcerpt(100, get_the_content(true, true)); ?></p>
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
			?>
		</div>
	</div>
<?php
else:
	echo 'non';
endif;
