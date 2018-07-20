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
          <?php if (is_user_logged_in()) : $user = wp_get_current_user(); ?>
            <h3 class="user"><a href="<?php echo $cart_url; ?>"><span class="item-cart"><?php echo $item_in_cart; ?></span> Item(s)</a> | <?php echo $user->user_login; ?>: <strong><?php echo get_user_meta($user->ID, 'credit', true); ?></strong></h3>
          <?php endif; ?>
        </div>
      </header>
      <main>