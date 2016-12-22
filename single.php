<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

setPostViews(get_the_ID());
?>

<?php get_header();?>
<div class="main-content">
    <?php if ( have_posts() ) : ?>
        <?php custom_breadcrumbs(); ?>

        <?php while ( have_posts() ): the_post(); ?>
            <?php get_template_part( 'content', get_post_format() ); ?>
        <?php endwhile;?>
    <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>
</div>
<?php get_footer();?>