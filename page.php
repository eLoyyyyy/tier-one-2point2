<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

?>

<?php get_header(); ?>
    <div class="row">
        <?php if ( have_posts() ) : ?>
        <section class="col l8 m12 s12">
            <?php custom_breadcrumbs(); ?>
        </section>
        <section class="main-content col l8 m12 s12" itemscope itemtype="http://schema.org/Blog">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>
        </section> <!-- main content -->
        <?php else : ?>
        <section class="main-content col l8 m12 s12" itemscope itemtype="http://schema.org/Blog">
            <?php get_template_part( 'content', 'none' ); ?>
        </section> <!-- main content -->
        <?php endif; ?>
        <aside class="col l4 m12 s12" itemscope itemtype="http://schema.org/WPSideBar">
            <?php get_sidebar(); ?>
        </aside>
    </div><!-- .bootstrap cols -->
<?php get_footer(); ?>
