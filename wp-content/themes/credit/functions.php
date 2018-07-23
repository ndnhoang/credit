<?php
/**
 * @link http://www.hoangblogger.com/
 * @package blog
 * @author hoangblogger
 */

if ( ! function_exists( 'blog_setup' ) ) :
	function blog_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'blog' ),
			'iconic-vintage' => esc_html__( 'Iconic Vintage', 'blog' ),
			'client-services' => esc_html__( 'Client Services', 'blog' ),
			'contact-us' => esc_html__( 'Contact Us', 'blog' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'blog_setup' );
/**
 * Register widget area
 */
function blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Iconic Vintage', 'blog' ),
		'id'            => 'iconic_vintage',
		'description'   => esc_html__( 'Add widgets here.', 'blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'blog_widgets_init' );
//enqueue scripts
function blog_scripts() {		
	wp_enqueue_style( 'blog-style', get_stylesheet_uri() );
	wp_enqueue_style( 'main.css', get_template_directory_uri().'/css/main.css' );

	wp_enqueue_script( 'main.js', get_template_directory_uri().'/js/main.js',array('jquery'), '3.8', true );
}
add_action( 'wp_enqueue_scripts', 'blog_scripts' );
/**
 * Theme option
 */
require get_template_directory() . '/inc/theme-option.php';
/**
 * BFI_Thumb
 */
require get_template_directory() . '/BFI_Thumb.php';
/**
 * Shortcode
 */
require_once get_template_directory() . '/inc/shortcode.php';
//hide adminbar
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}
//filter logout
add_action( 'wp_logout', 'auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
  wp_redirect(home_url());
  exit();
}
//filter wp mail html
add_filter('wp_mail_content_type','wpdocs_set_html_mail_content_type');
function wpdocs_set_html_mail_content_type($content_type){
	return 'text/html';
}
//funtion crop_img
function crop_img($w, $h, $url_img){
 $params = array( 'width' => $w, 'height' => $h, 'crop' => true);
 return bfi_thumb($url_img, $params );
}
//funtion crop_img
function get_favicon(){
    global $blog_option;
    $favicon  = $blog_option['favicon'];
    echo '<link rel="icon" type="image/png" href="'.$favicon['url'].'" sizes="32x32"/>';
}
//update version acf
function my_acf_init() {	
	acf_update_setting('select2_version', 4);	
	acf_update_setting('google_api_key', 'AIzaSyD9pVsP-Sh5vKDOU_6mGP3weZYs9qsX2wE');
}
add_action('acf/init', 'my_acf_init');
// fix woocommerce lastest
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// add credit field in user profile
if (!function_exists('extra_user_profile_fields')) {
	function extra_user_profile_fields($user) { ?>
		<h2><?php _e("Extra profile information", "credit"); ?></h2>
		<table class="form-table">
		    <tr>
		        <th><label for="credit"><?php _e("Credit"); ?></label></th>
		        <td>
		            <input type="number" name="credit" id="credit" value="<?php echo esc_attr( get_the_author_meta( 'credit', $user->ID ) ); ?>" class="regular-text" >
		        </td>
		    </tr>
		</table>
	<?php }
}
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
// save credit value  in user profile
if (!function_exists('save_extra_user_profile_fields')) {
	function save_extra_user_profile_fields($user_id) {
		if ( !current_user_can( 'edit_user', $user_id ) ) { 
	        return false; 
	    }
	    update_user_meta( $user_id, 'credit', $_POST['credit'] );
	}
}
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
//update item in cart
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {   
    $fragments['.item-cart'] = '<span class="item-cart">' . WC()->cart->get_cart_contents_count() . '</span>';    
    return $fragments;   
}
// add setting tab woocommerce
class WC_Settings_Tab_Process {
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_tab_custom-setting', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_settings_tab_custom-setting', __CLASS__ . '::update_settings' );
    }
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_custom-setting'] = __( 'Credit', 'woocommerce-settings-custom-credit' );
        return $settings_tabs;
    }
    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }
    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }
    public static function get_settings() {
        $settings = array(
            'section_title' => array(
                'name'     => __( 'Setting Credit', 'woocommerce-settings-tab-custom-setting' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_settings_tab_custom-setting_section_title'
            ),
            'Unit' => array(
                'name' => __( 'Unit', 'custom_credit_unit' ),
                'type' => 'text',
                'desc' => __( '1$ = ? credit', 'woocommerce-settings-tab-custom-setting' ),
                'id'   => 'custom_credit_unit'
            ),
            'Credit' => array(
                'name' => __( 'Credit', 'custom_credit_credit' ),
                'type' => 'text',
                'desc' => __( '1 credit = ? $', 'woocommerce-settings-tab-custom-setting' ),
                'id'   => 'custom_credit_credit'
            ),
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc_settings_tab_custom-setting_section_end'
            )
        );
        return apply_filters( 'wc_settings_tab_custom-setting_settings', $settings );
    }
}
WC_Settings_Tab_Process::init();
// apply credit
if (!function_exists('apply_credit')) {
	function apply_credit() {
		$user = wp_get_current_user();
		$current_credit = get_user_meta($user->ID, 'credit', true);
		if ($current_credit >= $_REQUEST['credit']) {
			$credit = calc_credit($_REQUEST['credit']);
			$credit_order = get_user_meta($user->ID, 'credit_order', true);
			if ($credit_order == null) {
				add_user_meta($user->ID, 'credit_order', $credit, true);
			} else {
				update_user_meta($user->ID, 'credit_order', $credit);
			}

			do_action( 'woocommerce_cart_collaterals' );
		} else {
			echo '0';
		}
		exit;
	}
	add_action( 'wp_ajax_nopriv_apply_credit', 'apply_credit' );
	add_action( 'wp_ajax_apply_credit', 'apply_credit' );
}

function calc_credit($credit) {
	$custom_credit_credit = get_option('custom_credit_credit');
	$custom_credit_credit = floatval($custom_credit_credit);
	$credit = intval($credit);
	$credit = $credit * $custom_credit_credit;
	return $credit;
}

function custom_calculated_total( $total, $cart ){
	$user = wp_get_current_user();
	$credit = get_user_meta($user->ID, 'credit_order', true);
	$credit = floatval($credit);
    return $total - $credit;
}
add_filter( 'woocommerce_calculated_total', 'custom_calculated_total', 10, 2 );

// custom checkout
if (!function_exists('custom_checkout')) {
	function custom_checkout() {
		add_filter( 'woocommerce_calculated_total', 'custom_calculated_total', 10, 2 );
		
	    WC()->checkout();
	    
		exit;
	}
	add_action( 'wp_ajax_nopriv_custom_checkout', 'custom_checkout' );
	add_action( 'wp_ajax_custom_checkout', 'custom_checkout' );
}