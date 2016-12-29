<?php




function tierone_media_scripts( $hook ){
 if ( 'widgets.php' != $hook) {
  return;
 }
 wp_enqueue_style( 'wp-color-picker' );

 //Update Style with in the admin
 wp_enqueue_style( 'tierone-widgets', get_template_directory_uri() . '/inc/widgets/widgets.css');

 wp_enqueue_media();
 wp_enqueue_script( 'wp-color-picker' );
 wp_enqueue_script( 'tierone-media-upload', get_template_directory_uri() . '/inc/widgets/widgets.js', array('jquery'), ' ' , true);
}
add_action( 'admin_enqueue_scripts', 'tierone_media_scripts');



require_once 'ads_widget.php';

require_once 'bpa_widget.php';

require_once 'bpa2_widget.php';

require_once 'tod3_show_post.php';

require_once 'sep_text_widget.php';

function wp_gear_manager_admin_scripts() {
    wp_enqueue_media();
}

function wp_gear_manager_admin_styles() {
    wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');


// Register and load the widget
function load_widget() {
    register_widget( 'ads_widget' );
     register_widget( 'tod3_show_post' );
         /*register_widget( 'ads_150x150_multiple_widget' );*/
    register_widget( 'bpa_widget' );
    register_widget( 'bpa2_widget' );
    register_widget( 'sep_text_widget' );
    
    /*register_widget( 'ttwopointone_widget_text' );
 
  // Allow to execute shortcodes on ttwopointone_widget_text
  add_filter('ttwopointone_widget_text', 'do_shortcode');*/
    
    //register_widget( 'front_page_widget' );
    
    //register_widget( 'layout_one_widget' );
}
add_action( 'widgets_init', 'load_widget' );