<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

function change_avatar_css($class) {
    $class = str_replace("class='avatar", "class='avatar circle left z-depth-1", $class) ;
    return $class;
}
add_filter('get_avatar','change_avatar_css');
 

function tierone_tags(){
    $posttags = get_the_tags();
    if ($posttags) {
        foreach($posttags as $tag) {
            ?><a rel="tags" href="<?php echo get_tag_link($tag->term_id);?>"><span itemprop="keywords"><?php echo $tag->name;?></span></a>, <?php
        }
    }
}

function tonetwo_copyright() {
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
        SELECT
            YEAR(min(post_date_gmt)) AS firstdate,
            YEAR(max(post_date_gmt)) AS lastdate
        FROM
            $wpdb->posts
        WHERE
            post_status = 'publish'
    ");
    $output = '';
    if($copyright_dates) {
        $copyright = '<span itemprop="copyrightYear">'.$copyright_dates[0]->firstdate.'</span>';
        if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= ' - ' . $copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }
    return $output;
}


function get_first_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all( '/<img .+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
    $first_img = isset($matches[1][0]) ? $matches[1][0]: ''; 
    if ( empty( $first_img ) || is_null( $first_img ) ) :
        // defines a fallback imaage
        $first_img = get_template_directory_uri() . "/images/default.jpg";
    endif;

    return $first_img;
}

function get_attachment_id( $url ) {
	$attachment_id = 0;
	$dir = wp_upload_dir();
	if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
	}
	return $attachment_id;
}

remove_filter( 'the_excerpt', 'wpautop' );

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

$lang_support = array( 
    'yoast' => array (
        'id' => 'id_ID',
        'vn' => 'vi_VN', 
        'my' => 'ms_MY', 
        'en' => 'en_US'
    ),
    'html' => array(
        'id' => 'id',
        'vn' => 'vi', 
        'my' => 'ms', 
        'en' => 'en'
    )
    
);

function __language_attributes($lang){

  // ignore the supplied argument
  //$langs = array( 'id', 'vi', 'ms', 'en' );
  global $lang_support;

  // change to whatever you want
  $lang = get_theme_mod( 'force_locale', 'en' );
  $my_language = $lang_support['html'][$lang];

  // return the new attribute
  return 'lang="'.$my_language.'"';
}
add_filter('language_attributes', '__language_attributes');

function yst_wpseo_change_og_locale( $locale ) {
    global $lang_support;

    // change to whatever you want
    $lang = get_theme_mod( 'force_locale', 'en' );
    return $lang_support['yoast'][$lang];
}
add_filter( 'wpseo_locale', 'yst_wpseo_change_og_locale' );

function jquery_enqueue_with_fallback() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery' , 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '3.1.1', true );
    wp_add_inline_script( 'jquery', 'window.jQuery||document.write(\'<script src="'.esc_url(includes_url()).'libs/js/jquery.js"><\/script>\')' );
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts' , 'jquery_enqueue_with_fallback' );

function time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}

function pagination($pages = '', $range = 4) {
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<ul class=\"pagination center-align\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class=\"waves-effect\"><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li class=\"waves-effect\"><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class=\"active\"><a href=\"\" class=\"inactive palette white-text\">".$i."</a></li>":"<li class=\"waves-effect\"><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<li class=\"waves-effect\"><a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a></lili>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class=\"waves-effect\"><a href='".get_pagenum_link($pages)."'>Last &raquo;</a><li>";
         echo "</ul>\n";
     }
}

function tieronetwo_next_prev_link()
{
     if (get_next_post() || get_previous_post()) : 
        $prev_post = get_previous_post();
        $next_post = get_next_post();
    ?>



    <!--<ul class="page-numbers menu-justified center-align">
        <li class="previous"><a rel="prev" href="<?php echo get_permalink($prev_post->ID) ;?>" class=" ">&laquo; Previous <?php echo ( is_single() ? 'post' : ( is_attachment() ? 'media' : '') ); ?></a></li>
        <li class="next"><a rel="next" href="<?php echo get_permalink($next_post->ID) ;?>" class=" ">Next <?php echo ( is_single() ? 'post' : ( is_attachment() ? 'media' : '') ); ?> &raquo;</a></li>
    </ul>-->

    <div class="row">
        <div class="col l6 m12 s12">
            <div class="card horizontal">
                <div class="card-image">
                    <img class="responsive-img" style="width:100px;height:112px;" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($prev_post->ID)) ;?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <a rel="next" href="<?php echo get_permalink($prev_post->ID) ;?>" class=" ">
                            <?php echo get_the_title($prev_post->ID); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l6 m12 s12">
            <div class="card horizontal">
                <div class="card-stacked">
                    <div class="card-content">
                        <a rel="next" href="<?php echo get_permalink($next_post->ID) ;?>" class=" ">
                            <?php echo get_the_title($next_post->ID); ?>
                        </a>
                    </div>
                </div>
                <div class="card-image">
                    <img class="responsive-img" style="width:100px;height:112px;" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($next_post->ID)) ;?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'">
                </div>
            </div>
        </div>
    </div>
    <?php endif;
}

function if_file_exists($image){
    stream_context_set_default(
        array(
            'http' => array(
                'method' => 'HEAD'
            )
        )
    );
    $headers = get_headers($image, 1);
    return stristr($headers[0], '200');
}

/**
 * Only use 'hentry' for post types with author and published date
 */
function remove_hentry( $classes, $class, $post_id ) {
    $hentry_post_types = array(
        'page'
    );
 
    $post_type = get_post_type( $post_id );
 
    if ( !in_array( $post_type, $hentry_post_types ) ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
 
    return $classes;
}
add_filter( 'post_class', 'remove_hentry', 10, 3 );