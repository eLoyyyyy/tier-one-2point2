<?php
/*
 * Template Name: Full Width Page Template
 */

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

?>

<?php get_header(); ?>
<main class="row">
    <?php custom_breadcrumbs(); ?>
    <section class="main-content col l7 offset-l2 m12 s12" itemscope itemtype="http://schema.org/Blog">
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'page' ); ?>

        <?php endwhile; // end of the loop. ?>
    </section> <!-- main content -->
</main><!-- .bootstrap cols -->
<?php get_footer(); ?>
