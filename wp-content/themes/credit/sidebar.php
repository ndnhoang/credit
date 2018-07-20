<?php
/**
 * @link http://www.hoangblogger.com/
 * @package blog
 * @author hoangblogger
 */
get_header();

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}?>

<aside id="secondary" class="sidebar-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
