<?php get_header(); ?>

    <div class="row">
        <div class="col l12 m12 s12">
           <header class="search-page-header row">
                <?php custom_breadcrumbs(); ?>
                <h2 class="h4"><?php printf(__( '<span class="search-title-span">Search Results for: </span> %s', 'tieronetwo' ), '<span>' . get_search_query() . '</span>'); ?></h2>
            </header>
        </div>
    </div>

    <div class="row">
        <aside class="col l3 m4 s12 hide-on-small-only">
            <?php 
            if ( is_active_sidebar( 'left-sidebar' ) ) {
                dynamic_sidebar( 'left-sidebar' );
            } ?>
        </aside>
        <section class="main-content col l6 m8 s12">
            <?php 
                if ( have_posts() ) : ?>
            
                    <?php while ( have_posts() ) : the_post(); ?>
            
                    <article class="blogpost card horizontal" itemscope itemtype="http://schema.org/BlogPosting">
                        <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
                        <header class="entry-meta site-meta-t">
                            <meta itemprop="author" content="<?php the_author();?>">
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
                        <div class="card-image">
                            <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" class="cat_box2a">
        
                                <?php if (has_post_thumbnail() ) { 
                                $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image();
                                ?>
                                <meta itemprop="url" content="<?php echo $file; ?>">
                                <?php 
                                    if (if_file_exists($file)) :
                                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                        <meta itemprop="width" content="<?php echo $width; ?>">
                                        <meta itemprop="height" content="<?php echo $height; ?>">
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img style="height:190px; width:300px" class="responsive-img" 
                                 src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                    </a>
                                <?php } ?>
                            </figure>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h2 class="h6"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            </div>
                            <div class="card-action">
                                <small><?php echo time_ago(); ?>
                                <?php if ( has_tag() ) : ?>
                                    in <?php the_tags('',', ',''); ?>
                                <?php endif; ?>
                                </small>
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
            <?php 
            if ( is_active_sidebar( 'right-sidebar' ) ) {
                dynamic_sidebar( 'right-sidebar' );
            } ?>
        </aside>
    </div>

<?php get_footer(); ?>