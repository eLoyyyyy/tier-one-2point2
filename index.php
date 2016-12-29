<?php 

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

get_header(); ?>

    <div class="row">
        <aside class="col l2 m12 s12">
            <?php get_sidebar(); ?>
        </aside>
        <section class="main-content col l7 m12 s12 hide-on-small-only">
            <?php 
                if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
            
                    <article class="blogpost card small" itemscope itemtype="http://schema.org/BlogPosting">
                        <?php _pre_post_meta(); ?>
                        <div class="card-image">
                            <?php _featured_image(); ?>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h2 class="h6"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                <small><?php echo time_ago(); ?></small>
                            </div>
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
            <?php get_sidebar(); ?>
        </aside>
    </div>

<?php get_footer(); ?>