<?php


?>


    <div class="sidebar">
        <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
                <?php dynamic_sidebar( 'main-sidebar' ); ?>
        <?php endif; ?>
    </div>