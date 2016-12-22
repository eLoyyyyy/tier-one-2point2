    </div>
</main> 

        <div class="outer-container white">
            <div class="center-align to-top palette darken-3">
                <a href="#"><i class="fa fa-chevron-up fa-2x white-text" aria-hidden="true"></i></a>
            </div>
        </div>
        <footer class="page-footer" class="http://schema.org/WPFooter">
            <div class="outer-container palette darken-3">
                <div class="container palette darken-3">
                    <div class="row" style="display:none;">
                        <div class="col l4 m4">
                            <div class="sidebar-1">
                                <h5 class="white-text">Footer Content</h5>
                                <p class="grey-text text-lighten-4">Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium.</p>
                            </div>
                            <?php if ( is_active_sidebar( 'footer_sidebar_1' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer_sidebar_1' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col l4 s12">
                            <div class="sidebar-2">
                                <h5 class="white-text">Footer Content</h5>
                                <p class="grey-text text-lighten-4">Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficial.</p>
                            </div>
                            <?php if ( is_active_sidebar( 'footer_sidebar_2' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer_sidebar_2' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col l4 s12">
                            <div class="sidebar-3">
                                <h5 class="white-text">Links</h5>
                                <ul>
                                    <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                                    <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                                    <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                                    <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                                </ul>
                            </div>
                            <?php if ( is_active_sidebar( 'footer_sidebar_3' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer_sidebar_3' ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l5 m12 s12">
                            <?php if ( is_active_sidebar( 'footer_sidebar_1' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer_sidebar_1' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col l3 m12 s12">
                            <?php if ( is_active_sidebar( 'footer_sidebar_2' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer_sidebar_2' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col l4 m12 s12">
                            <?php if ( is_active_sidebar( 'footer_sidebar_3' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer_sidebar_3' ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="outer-container palette darken-4">
                    <div class="container palette darken-4">
                        &copy; <?php echo tonetwo_copyright(); ?> <a href="<?php echo home_url(); ?>" itemscope itemtype="http://schema.org/Organization"><span itemprop="name"><?php echo force_relative_url(); ?></span></a>, All Rights Reversed.
                        <div class="social-media right">
                            <a class="grey-text text-lighten-4" href="#!"><i class="fa fa-facebook"></i></a>
                            <a class="grey-text text-lighten-4" href="#!"><i class="fa fa-twitter"></i></a>
                            <a class="grey-text text-lighten-4" href="#!"><i class="fa fa-linkedin"></i></a>
                            <a class="grey-text text-lighten-4" href="#!"><i class="fa fa-instagram"></i></a>
                            <a class="grey-text text-lighten-4" href="#!"><i class="fa fa-pinterest-p"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </footer>

    <?php wp_footer(); ?>
    </body>
</html>