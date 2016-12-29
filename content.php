<?php 

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 

?>



        

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <article itemprop="mainEntity" itemscope itemtype="http://schema.org/Article">
        <?php _pre_post_meta(); ?>
        <?php //tierone_featured_image();
        ?>
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="section">
                    <?php the_title( '<h2 class="h4 genpost-entry-title" itemprop="headline">', '</h2>' ); ?>
                </div>
                <div class="divider"></div>
            </div>
            <div class="col l12 m12 s12">   
                <?php _featured_image(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col l2 m4 s12 center">
                <div class="section">
                    <div class="blog-date">
                        <span class="day"><?php the_time( 'd' ); ?></span>
                        <span class="month"><?php the_time( 'F' ); ?></span>
                        <span class="year"><?php the_time( 'Y' ); ?></span>
                    </div>
                    <p class="entry-meta site-meta-t">
                        by <?php the_author(); ?>
                     </p> 
                    <?php _social_media(); ?>
                </div>
            </div>
            <div class="col l7 m8 s12">
                <div class="section">
                    <div itemprop="articleBody" class="flow-text"><?php the_content();?></div>
                </div>
            </div>
            <div class="col l3 m12 s12">
                <?php get_sidebar(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col l7 offset-l2">
                <div class="divider"></div>
                <div class="section">
                    <p>

                    <?php if ( comments_open() && pings_open() ) {
                    // Both Comments and Pings are open ?>
                    You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" >trackback</a> from your own site.

                    <?php } elseif ( !comments_open() && pings_open() ) {
                    // Only Pings are Open ?>
                    Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " >trackback</a> from your own site.

                    <?php } elseif ( comments_open() && !pings_open() ) {
                    // Comments are open, Pings are not ?>
                    You can skip to the end and leave a response. Pinging is currently not allowed.

                    <?php } elseif ( !comments_open() && !pings_open() ) {
                    // Neither Comments, nor Pings are open ?>
                    Both comments and pings are currently closed.

                    <?php } edit_post_link('Edit this entry','','.'); ?>

                    </p>
                    <?php _social_media(); ?>
                    
                    <div class="fixed-action-btn click-to-toggle hide-on-large-only">
                        <a class="btn-floating btn-large blue">
                            <i class="fa fa-bars"></i>
                        </a>
                        <ul>
                            <li>
                                <button class="facebook btn-floating social-share" data-share="facebook" >
                                    <i class="fa fa-facebook fa-fw" aria-hidden="true"></i>
                                </button>
                            </li>
                            <li>
                                <button class="twitter btn-floating social-share" data-share="twitter">
                                    <i class="fa fa-twitter fa-fw" aria-hidden="true"></i>
                                </button>
                            </li>
                            <li>
                                <button class="linkedin btn-floating social-share" data-share="linkedin">
                                    <i class="fa fa-linkedin fa-fw" aria-hidden="true"></i>
                                </button>
                            </li>
                            <li>
                                <button class="reddit btn-floating social-share" data-share="reddit" target='_blank' href=''>
                                    <i class="fa fa-reddit-alien fa-fw " aria-hidden="true"></i>
                                </button>
                            </li>
                            <li>
                                <button class="google-plus btn-floating social-share" data-share="google-plus">
                                    <i class="fa fa-google-plus fa-fw social-share" aria-hidden="true"></i> 
                                </button>
                            </li>
                            <li>
                                <?php $image = ( has_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0] : get_first_image() ; ?>
                                <button class="pinterest btn-floating social-share" data-share="pinterest" data-title="<?php urlencode(the_title()) ;?>" data-image="<?php echo esc_url( $image ); ?>">
                                    <i class="fa fa-pinterest fa-fw " aria-hidden="true"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <section>
                        <?php if ( has_tag() ) : ?>
                            <h2 class="h4">Read more articles about</h2> 
                            <ul class="list-inline black-border">
                             <?php /*the_tags('<ul class="list-inline black-border"><li>','</li><li>','</li></ul>');*/
                                tierone_tags(); 
                            ?>   
                            </ul>
                            
                        <?php endif; ?>
                    </section>
                    
                    <?php
                        get_template_part( 'content', 'related' ); //related post
                    ?>
                    
                    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-width="100%"></div>
                    
                        
                    <div itemprop="interactionStatistic" itemscope itemtype="http://schema.org/InteractionCounter">
                        <meta itemprop="interactionType" content="http://schema.org/CommentAction"/>
                        <meta itemprop="userInteractionCount" content="<?php echo get_comments_number(); ?>" />
                    </div>
                    
                    
                    <?php
                        comments_template();              
                    ?>

                    <?php tieronetwo_next_prev_link();?> 
                </div>
            </div>
        </div>
    </article>
</div>

        
        