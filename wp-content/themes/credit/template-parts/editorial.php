<?php
/**
 * Template Name: Editorial
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */
get_header(); ?>
	<div class="editorial">
		<div class="container">
			<?php if (have_rows('list_editorial')) : ?>
				<div class="list-editorial">
					<?php while (have_rows('list_editorial')) : 
						the_row();
						$image = get_sub_field('image');
						$title = get_sub_field('title');
						$sub_title = get_sub_field('sub_title');
						$description = get_sub_field('description');
						?>
						<div class="item">
							<?php if ($image) : ?>
								<div class="thumb">
									<img class="lazyload" data-origin="<?php echo $image; ?>" src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
								</div>
							<?php endif; ?>
							<?php if ($title || $sub_title || $description) : ?>
								<div class="content">
									<div class="content-left">
										<?php if ($title) : ?><h3><?php echo $title; ?></h3><?php endif; ?>
										<?php if ($sub_title) : ?><h5><?php echo $sub_title; ?></h5><?php endif; ?>
									</div>
									<div class="content-right"><?php echo $description; ?></div>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif ?>
		</div>
	</div>
<?php get_footer();