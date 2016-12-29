<?php 

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

get_header(); ?>
<section class="main-content center-align four-o-four-wrapper">
    <div class="row clearfix">
        <div class="col l12 m12 s12">
            <div class="row">
                <div class="col l12 m12 s12">
                    <p><?php _e('We&#39;re sorry, but the page you&#39;re looking for does not exist.', 'tieronetwo'); ?></p>
                    <p>
                        <?php 
                        printf( 
                            __('<a class="btn btn-large palette" href="%s">Return to Home</a>', 'tieronetwopointone'),
                            home_url(),
                            esc_url( wp_get_referer() ) 
                            );
                        ?>
                    </p>
                </div>
            </div>
            <h2 class="h5">You could try searching what you're looking for.</h2>
            <div class="row">
                <div class="col l8 offset-l2 m10 offset-m1 s12">
                    <div class="row">
                         <form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
                            <div class="input-field inline col l8 m12 s12" style="margin-top:0px;">
                                <input id="search" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search ' . force_relative_url(), 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"/>
                            </div>
                            <button class="btn palette waves-effect waves-light col l4 m12 s12" type="submit">
                                Submit
                            </button>
                        </form>   
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php
    $args = array(
        'posts_per_page' => 3,
    );
    $query = new WP_Query( $args ); 
    ?>
    <?php if ( $query->have_posts() ) : ?>
    <div class="row clearfix">
        <div class="strike">
            <span class="h5">Some of our latest posts.</span>
        </div>
        <div class="flexbox-container">
        <?php while( $query->have_posts() ) : $query->the_post(); ?>
            <article class="col l4 m6 s12" > <!-- itemscope itemtype="http://schema.org/ItemPage" -->
                <meta itemprop="relatedLink" content="<?php echo get_permalink();?>">
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
                                <img style="height:145px" class="responsive-img" 
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
                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:145px" /> <!-- itemprop="image" -->
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
</section>

<?php get_footer(); ?>