<?php
/**
 * Template Name: Embroidery
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */
$banner = get_field('banner_top');
$title = get_field('title');
$image = get_field('image');
$content_left = get_field('content_left');
$content_right = get_field('content_right');
$bg_bottom = get_field('background_bottom');
get_header(); ?>
	<div class="embroidery">
		<?php if ($banner) : ?>
			<div class="page-banner"><img src="<?php echo $banner; ?>" alt="banner"></div>
		<?php endif; ?>
		<div class="content" style="background-image: url(<?php echo $bg_bottom; ?>); ">
			<div class="container">
				<div class="content-left">
					<h2><?php echo $title; ?></h2>
					<?php if ($image) : ?>
						<img class="lazyload" data-origin="<?php echo $image; ?>" src="<?php echo $image; ?>" alt="">
					<?php endif; ?>
					<div class="desc"><?php echo $content_left; ?></div>
				</div>
				<div class="content-right">
					<div class="desc"><?php echo $content_right; ?></div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();