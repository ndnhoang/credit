<?php
/**
 * Template Name: Story
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */

get_header(); ?>
	<div class="story">
		<div class="container">
			<?php if (have_rows('introduction')) : ?>
				<div class="introduction">
					<?php while (have_rows('introduction')) : 
						the_row();
						$image = get_sub_field('image');
						$title = get_sub_field('title');
						$description = get_sub_field('description');
						?>
						<div class="content-left">
							<?php if ($image) : ?>
								<img class="lazyload" data-origin="<?php echo $image; ?>" src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
							<?php endif; ?>
						</div>
						<div class="content-right">
							<h3><?php echo $title; ?></h3>
							<div class="description"><?php echo $description; ?></div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<?php if (have_rows('timeline')) : $count = 0; ?>
				<div class="timeline">
					<h3>Timeline</h3>
					<div class="first"><div class="content-left"><span class="circle"></span></div></div>
					<?php while (have_rows('timeline')) : 
						the_row();
						$count++;
						$time = get_sub_field('time');
						$image = get_sub_field('image');
						$title = get_sub_field('title');
						$description = get_sub_field('description');
						?>
						<div class="item <?php echo ($count == 1) ? 'active' : ''; ?>">
							<div class="content-left">
								<span class="time"><?php echo $time; ?></span>
								<span class="circle"></span>
							</div>
							<div class="content-right">
								<div class="thumb" style="background-image: url(<?php echo $image; ?>)"></div>
								<div class="information">
									<div class="image" style="background-image: url(<?php echo $image; ?>)"></div>
									<h4><?php echo $title; ?></h4>
									<div class="description"><?php echo $description; ?></div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php get_footer();