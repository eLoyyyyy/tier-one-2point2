<?php get_header(); ?>
    <div class="row">
        <?php if ( is_active_sidebar( 'front_page_top_sidebar' ) ) : ?>
                <?php dynamic_sidebar( 'front_page_top_sidebar' ); ?>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col l8 m12 s12">
            <?php if ( is_active_sidebar( 'front_page_sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'front_page_sidebar' ); ?>
            <?php endif; ?>
        </div>
        <div class="col l4 m12 s12">
            <?php get_sidebar(); ?>
        </div>
    </div>

<?php get_footer(); ?>