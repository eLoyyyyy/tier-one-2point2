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
        ?><li><a href="<?php echo get_tag_link($tag->term_id); ?>"><span itemprop="keywords"><?php echo $tag->name; ?></span></a></li><?php 
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
        $copyright = '<span>'.$copyright_dates[0]->firstdate.'</span>';
        if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= ' - ' . $copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }
    return $output;
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
    wp_register_script( 'jquery-js' , 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), false, false );
    wp_add_inline_script( 'jquery-js', 'window.jQuery||document.write(\'<script src="'.esc_url(includes_url()).'libs/js/jquery.js"><\/script>\')' );
    wp_enqueue_script( 'jquery-js' );
    
}
add_action( 'wp_enqueue_scripts' , 'jquery_enqueue_with_fallback' );

function WPad46a5wc4(){
    ?> <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> <?php
}

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

    <div class="row flexbox-container">
        <?php if ( $prev_post ) : ?>
        <div class="col l6 m12 s12">
            <div class="card previous-article hoverable">
                <div class="card-content right-align">
                    <p class="card-title">Previous</p>
                    <a rel="next" href="<?php echo get_permalink($prev_post->ID) ;?>" class="grey-text text-lighten-1">
                        <?php echo get_the_title($prev_post->ID); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ( $next_post ) : ?>
        <div class="col l6 <?php echo ( $prev_post ? '' : 'offset-l6' ); ?>m12 s12">
            <div class="card next-article hoverable">
                <div class="card-content">
                    <p class="card-title">Next</p>
                    <a rel="next" href="<?php echo get_permalink( $next_post->ID ) ;?>" class="grey-text text-lighten-1">
                        <?php echo get_the_title( $next_post->ID ); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
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
/*
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
}*/

function get_first_image(){ 
   preg_match( '/<img .+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_content() ,$matches);
   return isset($matches[1]) ? $matches[1]: false; 
}

function _featured_image_url(){
    return wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image() ?: get_template_directory_uri() . "/images/default.jpg";
}

function _featured_image(){?>
    <figure class="figure center-align" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        <?php $file = _featured_image_url(); ?>

        <?php
        if ( if_file_exists($file) ) :
            list($width, $height, $type, $attr) = getimagesize($file);  ?>
            <meta itemprop="width" content="<?php echo $width; ?>">
            <meta itemprop="height" content="<?php echo $height; ?>">
        <?php else : ?>
            <meta itemprop="width" content="">
            <meta itemprop="height" content="">
        <?php endif; ?>
        <link itemprop="url" href="<?php echo $file; ?>">
        <a href="<?php the_permalink(); ?>">
            <img class="responsive-img" src="<?php echo $file; ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="contentUrl">
        </a>
    </figure>
<?php
}

function _pre_post_meta(){?>
    <header class="genpost-entry-header">
        <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
        <span itemprop="author" itemscope itemtype="http://schema.org/Person"><?php ; ?>
            <link itemprop="url" href="<?php echo get_author_posts_url( the_author_meta( 'ID' ) ); ?>">
            <meta itemprop="name" content="<?php the_author(); ?>">
        </span>
        <meta itemprop="datePublished" content="<?php the_time('c'); ?> ">
        <meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>">
        <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
            <?php $logo = get_theme_mod( 'site_logo', '' ); 
            if ( !empty($logo) ) : ?>
            <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                <meta itemprop="url" content="<?php echo esc_url( $logo ); ?>">
            </span>
            <?php endif; ?>
            <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
        </span>
        <?php 
            global $lang_support;
            $lang = get_theme_mod( 'force_locale', 'en' );
        ?>
        <meta itemprop="inLanguage" content="<?php echo $lang_support['html'][$lang]; ?>">
    </header>
<?php
}

