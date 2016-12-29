<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; 
?>



        

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <article itemprop="mainEntity" itemscope itemtype="http://schema.org/Article">
        <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
        <header class="genpost-entry-header">
            <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                <meta itemprop="url" content="#">
                <meta itemprop="name" content="<?php the_author(); ?>">
            </span>
            <meta itemprop="datePublished" content="<?php the_time('c'); ?> ">
            <meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>">
            <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                <?php $logo = get_theme_mod( 'site_logo', '' ); 
                if ( !empty($logo) ) : ?>
                <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                    <meta itemprop="url" content="<?php echo esc_url( $logo ); ?>">
                </span>
                <?php endif; ?>
                <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
            </span>
            <?php 
                global $lang_support;
                $lang = get_theme_mod( 'force_locale', 'en' );
            ?>
            <meta itemprop="inLanguage" content="<?php echo $lang_support['html'][$lang]; ?>">
        </header>
        <?php //tierone_featured_image();
        ?>
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="section">
                    <?php the_title( '<h2 class="h4 genpost-entry-title" itemprop="headline">', '</h2>' ); ?>
                    <p class="entry-meta site-meta-t">
                        by <?php the_author(); ?>
                     </p> 
                    <p class="site-meta-t">
                        <small>
                            <time>
                                <?php echo time_ago(); ?>
                            </time>
                        </small>
                    </p>
                    <?php _social_media(); ?>
                </div>
                <div class="divider"></div>
            </div>
            <div class="col l12 m12 s12">            
                <figure class="figure center-align" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                    <?php if (has_post_thumbnail() ) { ?>
                    <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                    <?php
                        $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                        if (if_file_exists($file)) :
                            list($width, $height, $type, $attr) = getimagesize($file);  ?>
                            <meta itemprop="width" content="<?php echo $width; ?>">
                            <meta itemprop="height" content="<?php echo $height; ?>">
                        <?php else : ?>
                            <meta itemprop="width" content="">
                            <meta itemprop="height" content="">
                        <?php endif; ?>
                    <?php } else { ?>
                    <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                    <?php
                        $file = get_first_image(); 
                        if (if_file_exists($file)) :
                            list($width, $height, $type, $attr) = getimagesize($file);  ?>
                            <meta itemprop="width" content="<?php echo $width; ?>">
                            <meta itemprop="height" content="<?php echo $height; ?>">
                        <?php else : ?>
                            <meta itemprop="width" content="">
                            <meta itemprop="height" content="">
                        <?php endif; ?>
                    <?php } ?>

                </figure>
            </div>
        </div>
        <div class="row">
            <div class="col l8 m12 s12">
                <div class="section">
                    <div itemprop="articleBody" class="flow-text"><?php the_content();?></div>
                </div>
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
                    <section>
                        <?php if ( has_tag() ) : ?>
                            <h2 class="h4">Read more articles about</h2> 
                            <?php the_tags('<ul class="list-inline black-border"><li>','</li><li>','</li></ul>'); ?>
                        <?php endif; ?>
                    </section>
                    
                    <?php
                        get_template_part( 'content', 'related' ); //related post
                    ?>

                    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-width="100%"></div>


                    <div class="hide-on-med-and-down">
                        <?php
                            if ( comments_open() || '0' != get_comments_number() )
                                 comments_template();              
                        ?>
                    </div>

                    <?php tieronetwo_next_prev_link();?> 
                </div>
            </div>
            <div class="col l4 m12 s12">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </article>
</div>

        
        