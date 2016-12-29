<?php 

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

get_header(); ?>

    <div class="row clearfix">
        <section class="col l3 m4 s12">
        <?php 
            if ( is_active_sidebar( 'left-sidebar' ) ) {
                dynamic_sidebar( 'left-sidebar' );
            } else { ?>
            <div class="section">
                <div class="section-title">
                    <h1 class="h5">Section Title</h1>
                </div>
                <div class="section-content">
                    <?php 
                    $args = array(
                        'posts_per_page'  => 6,
                        'post_type' => 'post',
                        'tax_query' => array( array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
                            'operator' => 'NOT IN'
                        ) )
                    );
                    $query = new WP_Query( $args ); 

                    if ( $query->have_posts() ) : ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="card">
                        <div class="card-content clearfix">
                            <div class="card-img">
                                <?php $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image(); ?>
                                <img class="responsive-img" src="<?php echo $file; ?>">
                            </div>
                            <div class="card-ttle">
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#!"><?php echo $post->comment_count; ?></a>
                                <i class="fa fa-eye" aria-hidden="true"></i><a href="#!"><?php echo getPostViews(get_the_ID()); ?></a>
                            </div>
                        </div>
                    </div>
                        <?php endwhile;
                    endif; wp_reset_query(); ?>
                </div>
            </div>
            <div class="divider">
            
            </div>
            <div class="section">
                <div class="section-title">
                    <h1 class="h5">Section Title (puro Image)</h1>
                </div>
                <div class="section-content">
                    <?php 
                    $args = array(
                        'posts_per_page'  => 6,
                        'post_type' => 'post',
                        'tax_query' => array( array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
                            'operator' => 'NOT IN'
                        ) )
                    );
                    $query = new WP_Query( $args ); 

                    if ( $query->have_posts() ) : ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="card">
                        <div class="card-content center">
                            <figure class="imghvr-push-up">
                                <?php $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image(); ?>
                                <img class="soft-crop" src="<?php echo $file; ?>">
                                <figcaption>
                                    <h1 class="h5"><?php the_title(); ?></h1>
                                </figcaption>
                                <a href="<?php the_permalink(); ?>"></a>
                            </figure>
                        </div>
                    </div>
                        <?php endwhile; 
                    endif; wp_reset_query(); ?>
                </div>
            </div>
        <?php } ?>
            
            
        </section>
        <?php
        $args = array("hide_empty" => 0,
                        "type"      => "post",      
                        "orderby"   => "count",
                        "order"     => "DESC" );
        $categories = get_categories( $args ); ?>
        
        
        <div class="col l6 m8 s12">
            <div class="section">
                <div class="section-title">
                    <h1 class="h5"><?php echo get_cat_name( $categories[0]->term_id ) ?></h1>
                </div>
                <div class="section-content">
                    <?php 
                    $x = 0;
                    $args = array(
                        'posts_per_page'  => 5,
                        'cat' => $categories[0]->term_id,
                        'tax_query' => array( array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
                            'operator' => 'NOT IN'
                        ) )
                    );
                    $query = new WP_Query( $args ); 

                    if ( $query->have_posts() ) : ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); 
                            if($x==2) { ?>
                                <?php 
                                if ( is_active_sidebar( 'sm-sidebar' ) ) {
                                    dynamic_sidebar( 'sm-sidebar' );
                                } ?>
                                <?php 
                            }
                            $x++; ?>
                    <div class="card blue">
                        <div class="card-image ">
                            <?php $file = _featured_image_url(); ?>
                            <img class="responsive-img soft-crop" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" src="<?php echo $file; ?>">
                            <div class="card-overlay">
                                <div class="overlay-wrapper">
                                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                    <span class="hide-on-small-and-down">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                        <?php the_time('F j, Y h:s a', '<a href="#!">', '</a>'); ?>
                                    </span>
                                    <span class="hide-on-small-and-down">
                                        <i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;
                                        <a href="#!"><?php echo $post->comment_count; ?></a>
                                    </span>
                                    <span class="hide-on-small-and-down">
                                        <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
                                        <a href="#!"><?php echo getPostViews(get_the_ID()); ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php endwhile;
                    endif; wp_reset_query(); ?>
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">
                    <h1 class="h5"><h1 class="h5"><?php echo get_cat_name( $categories[1]->term_id ) ?></h1></h1>
                </div>
                <div class="section-content">
                    <?php 
                    $x = 0;
                    $args = array(
                        'posts_per_page'  => 4,
                        'cat' => $categories[1]->term_id,
                        'tax_query' => array( array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
                            'operator' => 'NOT IN'
                        ) )
                    );
                    $query = new WP_Query( $args ); 

                    if ( $query->have_posts() ) : ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); 
                            $file = _featured_image_url();
                                    if ( $x == 0 ) : ?>
                    <div class="top-bunk row flexbox-container">
                        <div class="col l6 m12 s12">
                            
                            <img class="responsive-img soft-crop" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:192px;" src="<?php echo $file; ?>">
                        </div>
                        <div class="col l6 m12 s12">
                            <h1 class="bunk-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </div>
                    <div class="bottom-bunk row flexbox-container">
                                    <?php else : ?>
                    
                        <div class="col l4 m6 s12 bunk">
                            <img class="responsive-img soft-crop" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:200px;" src="<?php echo $file; ?>">
                            <h1 class="h6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        </div>
                    <?php if ( $x == 3 ) : ?></div><?php endif; ?>
                                    <?php endif; $x++; ?>
                        <?php endwhile;
                    endif; wp_reset_query(); ?>
                </div>
            </div>
            
            
        </div>
        <div class="col l3 m12 s12">
        <?php 
            if ( is_active_sidebar( 'right-sidebar' ) ) {
                dynamic_sidebar( 'right-sidebar' );
            } else { ?>
            <div class="section">
                <div class="section-title">
                    <h1 class="h5">Advertisements</h1>
                </div>
                <div class="section-content">
                    <div class="row">
                        <div class="col l6 m4 s6">
                            <a href="#!">
                                <img class="responsive-img" src="http://placehold.it/300x300">
                            </a>
                        </div>
                         <div class="col l6 m4 s6">
                            <a href="#!">
                                <img class="responsive-img" src="http://placehold.it/300x300">
                            </a>
                        </div> 
                        <div class="col l6 m4 s6">
                            <a href="#!">
                                <img class="responsive-img" src="http://placehold.it/300x300">
                            </a>
                        </div>
                         <div class="col l6 m4 s6">
                            <a href="#!">
                                <img class="responsive-img" src="http://placehold.it/300x300">
                            </a>
                        </div> 
                        <div class="col l6 m4 s6">
                            <a href="#!">
                                <img class="responsive-img" src="http://placehold.it/300x300">
                            </a>
                        </div>
                         <div class="col l6 m4 s6">
                            <a href="#!">
                                <img class="responsive-img" src="http://placehold.it/300x300">
                            </a>
                        </div> 
                    </div>
                    <div class="center">
                        <span class="ad-sign">Advertisements</span>
                    </div>
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">
                    <h1 class="h5">Another Section</h1>
                </div>
                <div class="section-content">
                    <?php 
                    $x = 0;
                    $args = array(
                        'posts_per_page'  => 6,
                        'tax_query' => array( array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
                            'operator' => 'NOT IN'
                        ) )
                    );
                    $query = new WP_Query( $args ); 

                    if ( $query->have_posts() ) : ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="card small">
                        <div class="card-image">
                            <?php $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image(); ?>
                            <img class="responsive-img" src="<?php echo $file; ?>">
                        </div>
                        <div class="card-content">
                            <h1 class="h6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        </div>
                        <div class="card-action">
                            <span style="font-size:0.8rem">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                <?php the_time('F j, Y h:s a', '<a class="black-text" href="#!">', '</a>'); ?>
                            </span>
                        </div>
                    </div>
                        <?php endwhile;
                    endif; wp_reset_query(); ?>
                </div>
            </div>
            
            <div class="section center">
                <figure>
                <a href="#!"><img class="hoverable" src="http://placehold.it/160x600"></a>
                <figcaption class="ad-sign">Advertisement</figcaption>
                </figure>
            </div>
            <?php } ?>
            
        </div>
    </div>

<?php get_footer(); ?>