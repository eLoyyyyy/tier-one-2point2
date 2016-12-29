<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="mainEntity" itemscope itemtype="http://schema.org/BlogPosting">
	<link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
    <header class="page-entry-header">
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
    
	<div class="entry-content" itemprop="text">
        <div class="section">
        <p class="entry-meta site-meta-t">
            <?php the_title( '<h2 class="genpost-entry-title" itemprop="headline">', '</h2>' ); ?>
         </p> 
        </div>
        <div class="divider"></div>
        <div class="section">
            <?php the_content(); ?>
        </div>
        <div class="divider"></div>
        <div class="section">
            <p>
                <?php edit_post_link('Edit this entry','','.'); ?>
            </p>
        </div>
        
	</div>
</article>