<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

// get the categories
$categories = get_the_category();
$cat_ids = array();
foreach($categories as $category) $cat_ids[] = $category->term_id;

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'rand',
    'category__in' => $cat_ids,
    'post__not_in' => array( get_the_ID() ),
    'posts_per_page' => 6
);

$posts_related = new WP_Query();
$posts_related->query($args);
if ( $posts_related->have_posts() ) :
?>

<div class="related-posts post-section">
    <div class="genpost-entry-header">
        <h4 class="genpost-entry-title"><?php esc_html_e('We Recommend', 'tieronetwopointone') ?></h4>
    </div>

    <div class="flexbox-container row clearfix">
        <?php while( $posts_related->have_posts() ) : $posts_related->the_post(); ?>
            <article class="col l4 m6 s12 center" > <!-- itemscope itemtype="http://schema.org/ItemPage" -->
                <div class="">
                    <figure class="figure card-image z-depth-0" > <!-- itemprop="image" itemscope itemtype="http://schema.org/ImageObject" -->
                        <?php if (has_post_thumbnail() ) { ?>
                        <!--  <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>"> -->
                        <?php
                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                            if (file_exists($file)) :
                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                <!-- <meta itemprop="width" content="<?php echo $width; ?>">
                                <meta itemprop="height" content="<?php echo $height; ?>"> -->
                            <?php endif; ?>
                                <img style="height:145px" class="responsive-img soft-crop" 
                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" > <!-- itemprop="image" -->
                        <?php } else { ?>
                        <!-- <meta itemprop="url" content="<?php echo get_first_image(); ?>"> -->
                        <?php
                            $file = get_first_image(); 
                            if (file_exists($file)) :
                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                <!-- <meta itemprop="width" content="<?php echo $width; ?>">
                                <meta itemprop="height" content="<?php echo $height; ?>"> -->
                            <?php endif; ?>
                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:145px" /> <!-- itemprop="image" itemscope itemtype="http://schema.org/URL"-->
                        <?php } ?>
                        <figcaption class="card-content text-center">
                            <?php echo '<h1 class="h6">' . '<a rel="bookmark" href="' . get_permalink() . '" title="'. get_the_title() .'">' . get_the_title() . '</a></h1>';?>
                        </figcaption>
                    </figure>
                    
                </div>
            </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<?php endif; ?>