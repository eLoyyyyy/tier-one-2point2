<?php 

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

get_header(); ?>

    <div class="row">
        <section>
           <header class="archive-header">
                <?php custom_breadcrumbs(); ?>
                <h1 class="h3 cat-header">Category: <?php single_cat_title(); ?></h1>

            <?php

            // Display optional category description
            if ( category_description() ) : ?>
                <div class="flow-text cat-description"><?php echo category_description(); ?></div>
            <?php endif; ?>
            </header>
        </section>
    </div>

    <div class="row">
        <aside class="col l3 m12 s12 hide-on-small-only">
            <?php 
            if ( is_active_sidebar( 'left-sidebar' ) ) {
                dynamic_sidebar( 'left-sidebar' );
            } ?>
        </aside>
        <section class="main-content col l6 m12 s12">
            <?php 
                if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
            
                    <article class="blogpost card small" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                        <?php _pre_post_meta(); ?>
                        <div class="card-image">
                            <?php _featured_image(); ?>
                        </div>
                        <div class="card-content">
                            <h2 class="h6"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            <small><?php echo time_ago(); ?></small>
                        </div>
                    </article>
            
                    <?php endwhile; 
                    global $wp_query;
                    pagination($wp_query->max_num_pages, 2);
                    
            
                else : ?>
                    
                    <?php get_template_part('content', 'none'); ?>
            
                <?php endif; ?>
        </section> <!-- main content -->
        <aside class="col l3 m12 s12 hide-on-small-only">
            <?php 
            if ( is_active_sidebar( 'right-sidebar' ) ) {
                dynamic_sidebar( 'right-sidebar' );
            } ?>
        </aside>
    </div>

<?php get_footer(); ?>