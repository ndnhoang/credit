<?php
// show contact
add_filter( 'widget_text', 'do_shortcode' );
add_shortcode('show_contact','show_contact');
function show_contact(){
    global $blog_option; 
    $phone  = $blog_option['phone'];
    $email  = $blog_option['email'];
    ob_start();
    if ($phone || $email) : ?>
        <ul>
            <?php if ($phone) : ?>
                <li><a href=tell:<?php echo $phone; ?>><?php echo $phone; ?></a></li>
            <?php endif; ?>
            <?php if ($email) : ?>
                <li><a href=mailto:<?php echo $email; ?>><?php echo $email; ?></a></li>
            <?php endif; ?>
        </ul>
    <?php endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//show socials
add_shortcode('show_socials_icon','show_socials_icon');
function show_socials_icon(){
    global $blog_option; 
    ob_start();?>
    <ul>
        <?php if( !empty($blog_option['facebook']) ): ?>
        <li><a class="facebook" href="<?php echo $blog_option['facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
        <?php endif; ?>
        <?php if( !empty($blog_option['instagram']) ): ?>
        <li><a class="instagram" href="<?php echo $blog_option['instagram']; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <?php endif; ?>
        <?php if( !empty($blog_option['twitter']) ): ?>
        <li><a class="twitter" href="<?php echo $blog_option['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
        <?php endif; ?>
    </ul>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}