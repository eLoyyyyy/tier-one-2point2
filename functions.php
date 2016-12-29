<?php 

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 



require get_template_directory() . '/inc/helpers.php';

require get_template_directory() . '/inc/reset.php';

function tier_one_two_styles_scripts(){
    wp_register_style('tier-one-twopointone-style', get_stylesheet_directory_uri() . '/css/style.min.css');
    wp_enqueue_style('tier-one-twopointone-style');
    wp_register_script('tier-one-two-script', get_stylesheet_directory_uri() . '/js/scripts.min.js');
    wp_enqueue_script('tier-one-two-script');
    
    wp_enqueue_style('google-noto', 'https://fonts.googleapis.com/css?family=Noto+Serif');
    wp_enqueue_style('material-icon', 'http://fonts.googleapis.com/icon?family=Material+Icons');
}
add_action('wp_enqueue_scripts', 'tier_one_two_styles_scripts');

require get_template_directory() . '/inc/features-init.php';

require get_template_directory() . '/inc/breadcrumbs.php';

require get_template_directory() . '/inc/walkers.php';

// Include better comments file
require get_template_directory() .'/inc/better-comments.php';

require get_template_directory() . '/inc/view-system.php';

require get_template_directory() . '/inc/multi_tab_widget.php';

require get_template_directory() . '/inc/widgets/widgets.php';




function force_relative_url()
{
    // get host name from URL
    preg_match("/^(http:\/\/)?([^\/]+)/i",home_url(), $matches);
    $host = $matches[2];

    // get last two segments of host name
    preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
    return strtoupper($matches[0]);
}

function _social_media(){
?>
    <div class="sm-action hide-on-med-and-down">
        <?php 
        $url = get_the_permalink(); 
        $url = urlencode(esc_url($url));?>
        
        <ul class="nav-inline">
            <li>
                <button class="facebook btn social-share" data-share="facebook" >
                    <i class="fa fa-facebook fa-fw" aria-hidden="true"></i>
                </button>
            </li>
            <li>
                <button class="twitter btn social-share" data-share="twitter">
                    <i class="fa fa-twitter fa-fw" aria-hidden="true"></i>
                </button>
            </li>
            <li>
                <button class="linkedin btn social-share" data-share="linkedin">
                    <i class="fa fa-linkedin fa-fw" aria-hidden="true"></i>
                </button>
            </li>
            <li>
                <button class="reddit btn social-share" data-share="reddit" target='_blank' href=''>
                    <i class="fa fa-reddit-alien fa-fw " aria-hidden="true"></i>
                </button>
            </li>
            <li>
                <button class="google-plus btn social-share" data-share="google-plus">
                    <i class="fa fa-google-plus fa-fw social-share" aria-hidden="true"></i> 
                </button>
            </li>
            <li>
                <?php $image = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0] : get_first_image() ; ?>
                <button class="pinterest btn social-share" data-share="pinterest" data-title="<?php urlencode(the_title()) ;?>" data-image="<?php echo esc_url( $image ); ?>">
                    <i class="fa fa-pinterest fa-fw " aria-hidden="true"></i>
                </button>
            </li>
        </ul>
        <div class="fb-save" data-uri="<?php the_permalink(); ?>" data-size="large"></div>
        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
        
    </div>
<?php
}

function themeslug_remove_hentry( $classes ) {
    if ( is_page() ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
    return $classes;
}
add_filter( 'post_class','themeslug_remove_hentry' );

function wpse71451_enqueue_comment_reply() {
    if ( get_option( 'thread_comments' ) ) { 
        wp_enqueue_script( 'comment-reply' ); 
    }
}
// Hook into comment_form_before
add_action( 'comment_form_before', 'wpse71451_enqueue_comment_reply' );


function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );