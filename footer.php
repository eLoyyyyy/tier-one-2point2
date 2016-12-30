
</main> 

        <footer class="page-footer black" class="http://schema.org/WPFooter">
            <div class="container">
                <div class="row">
                    <div class="col l4 m12 s12">
                        <div class="sidebar-1">
                            <h5 class="white-text">About Us</h5>
                            <p class="grey-text text-lighten-4">Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium.</p>
                            
                            <h5 class="white-text">Stay Connected</h5>
                            <div class="social-media center" >
                                <a class="grey-text text-lighten-4" itemprop="sameAs" id="facebookprof" href="#!"><i class="fa fa-facebook fa-fw"></i></a>
                                <a class="grey-text text-lighten-4" itemprop="sameAs" id="twitterprof" href="#!"><i class="fa fa-twitter fa-fw"></i></a>
                                <a class="grey-text text-lighten-4" itemprop="sameAs" id="linkedinprof" href="#!"><i class="fa fa-linkedin fa-fw"></i></a>
                                <a class="grey-text text-lighten-4" itemprop="sameAs" id="instagramprof" href="#!"><i class="fa fa-instagram fa-fw"></i></a>
                                <a class="grey-text text-lighten-4" itemprop="sameAs" id="pinterestprof" href="#!"><i class="fa fa-pinterest-p fa-fw"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col l4 m12 s12">
                        <div class="sidebar-2">
                            <h5 class="white-text">Categories</h5>
                            <ul class="footer-category left-align" id="double">
                                <?php
                                $args = array("hide_empty" => 0,
                                                "type"      => "post",      
                                                "orderby"   => "count",
                                                "order"     => "DESC",
                                                'number'    => 18);
                                $categories = get_categories( $args );
                                /*print_r( $categories ); */
                                foreach ( $categories as $category ) {
                                    if ( $category->count > 0 ) {
                                        echo '<li><a class="grey-text text-lighten-3" href="' 
                                            . get_category_link( $category->term_id ) 
                                            . '" rel="bookmark">' 
                                            . $category->name 
                                            . '</a><span class="badge">'. $category->category_count . '</span></li>';
                                    }
                                }
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col l4 m12 s12">
                        <div class="sidebar-3">
                            <h5 class="white-text">Latest Posts</h5>
                            <ul>
                                <?php 
                                $args = array(
                                    'posts_per_page'  => 3,
                                );
                                $query = new WP_Query( $args ); 
                                
                                if ( $query->have_posts() ) : ?>
                                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                        <li>
                                            <div class="post left-align clearfix">
                                                <div class="post-image">
                                                    <?php $file = _featured_image_url(); ?>
                                                    <a href="<?php the_permalink(); ?>"><img class="responsive-img soft-crop" style="height:89px;" alt="<?php the_title(); ?>" src="<?php echo $file; ?>"></a>
                                                </div>
                                                <div class="post-content">
                                                    <h1 class="h6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endwhile; 
                                endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright container">
                &copy; <?php echo tonetwo_copyright(); ?> <a href="<?php echo home_url(); ?>"><span><?php echo force_relative_url(); ?></span></a>, All Rights Reversed.
                <?php
                wp_nav_menu( array(
                     'container'=> false,
                    'theme_location'=>'secondary',
                    'menu_class' => 'footer-menu nav-inline right',
                    'walker' => new Wpse8170_Menu_Walker()
                ));
                ?>
            </div>
        </footer>

    <?php wp_footer(); ?>
    </body>
</html>