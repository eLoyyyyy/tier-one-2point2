<?php

require get_template_directory() . '/inc/reset.php';

require get_template_directory() . '/inc/helpers.php';

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

require get_template_directory() . '/inc/view-system.php';

require get_template_directory() . '/inc/material-comments.php';

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
        
        <p style="display:inline-block;">
            <button class="facebook btn social-share" data-share="facebook" >
                <i class="fa fa-facebook" aria-hidden="true"></i> Share
            </button>
        </p>
        <div class="fb-save" data-uri="<?php the_permalink(); ?>" data-size="large"></div>
        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
        <p>
            <button class="twitter btn social-share" data-share="twitter">
                <i class="fa fa-twitter" aria-hidden="true"></i> Tweet
            </button>
            <button class="linkedin btn social-share" data-share="linkedin">
                <i class="fa fa-linkedin" aria-hidden="true"></i> share
            </button>
            <button class="reddit btn social-share" data-share="reddit" target='_blank' href=''>
                <i class="fa fa-reddit-alien" aria-hidden="true"></i> reddit this!
            </button>
            <button class="google-plus btn social-share" data-share="google-plus">
                <i class="fa fa-google-plus social-share" aria-hidden="true"></i> share 
            </button>
            <?php $image = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0] : get_first_image() ; ?>
            <button class="pinterest btn social-share" data-share="pinterest" data-title="<?php urlencode(the_title()) ;?>" data-image="<?php echo esc_url( $image ); ?>">
                <i class="fa fa-pinterest" aria-hidden="true"></i> Pin
            </button>
        
        </p>
        
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
