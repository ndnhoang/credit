<?php
/**
 * Template Name: Contact
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */

get_header(); ?>
	<div class="contact-page">
		<?php $thumb = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); 
		if ($thumb) : ?>
			<div class="banner"><img class="lazyload" data-origin="<?php echo $thumb; ?>" src="<?php echo $thumb; ?>" alt="banner"></div>
			<div class="contact">
				<div class="container">
					<h2><?php echo get_the_title(); ?></h2>
					<div class="content">
						<div class="information">
							<?php if (have_rows('list_email')) : ?>
								<div class="list-email">
									<?php while (have_rows('list_email')) : 
										the_row();
										$title = get_sub_field('title');
										$email = get_sub_field('email');
									?>
										<div class="item">
											<span><?php echo $title; ?></span>
											<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="contact-form"><?php echo do_shortcode('[contact-form-7 id="153" title="Contact"]'); ?></div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php get_footer();