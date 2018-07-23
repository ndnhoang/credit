<?php
/**
 * @link http://www.hoangblogger.com/
 * @package blog
 * @author hoangblogger
 */
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();
$item_in_cart = $woocommerce->cart->cart_contents_count;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php get_favicon();?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="wrapper">
      <header>
        <div class="container text-right">
          <ul class="user-menu">
            <li><a href="<?php echo home_url(); ?>">Home</a></li>
            <li><a href="<?php echo $cart_url; ?>"><span class="item-cart"><?php echo $item_in_cart; ?></span> Item(s)</a></li>
            <?php if (is_user_logged_in()) : $user = wp_get_current_user(); ?>
              <li><?php echo $user->user_login; ?>: <strong><?php echo get_user_meta($user->ID, 'credit', true) ? get_user_meta($user->ID, 'credit', true) : 0; ?></strong> credit(s)</li>
            <?php endif; ?>
          </ul>
        </div>
      </header>
      <main>