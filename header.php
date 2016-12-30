<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif; ?>

<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
            <title><?php wp_title( '|', true, 'right' ); ?></title>
            <?php /* <meta name="description" content="<?php bloginfo('description'); ?>">;*/ ?>
            <link rel="profile" href="http://gmpg.org/xfn/11">
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
            <link rel="canonical" href="<?php bloginfo('url'); ?>">
            <?php WPad46a5wc4(); ?>
            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <?php wp_head(); ?>
        </head>

        <body class="custom-background" itemscope itemtype="http://schema.org/WebPage">
            <!--[if lt IE 9]>
                <script>
                    document.createElement("header" );
                    document.createElement("footer" );
                    document.createElement("section"); 
                    document.createElement("aside"  );
                    document.createElement("nav"    );
                    document.createElement("article"); 
                    document.createElement("hgroup" ); 
                    document.createElement("time"   );
                </script>
                <noscript>
                    <strong>Warning !</strong>
                    Because your browser does not support HTML5, some elements are created using JavaScript.
                    Unfortunately your browser has disabled scripting. Please enable it in order to display this page.
                </noscript>
                <![endif]-->
            
            <?php if ( is_singular() ) : 
                facebook_javascript_sdk(); 
            endif; ?>
            
            <!-- 
            <div class="preloader valign-wrapper blue-grey darken-4">
                <div class="preloader-wrapper valign big active" style="margin: 0 auto;">
                    <div class="spinner-layer spinner-white-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            
            <header>
                <nav class="main-nav black z-depth-0 nav-fixed" itemscope itemtype="http://schema.org/SiteNavigationElement">
                    <div class="container">
                        <div class="row nav-wrapper">
                            <div class="col l9">
                                
                                <?php $logo = get_theme_mod( 'site_logo', '' );
                                if ( !empty($logo) ) : ?>
                                <a href="<?php echo home_url(); ?>" class="brand-logo hide-on-large-only black-text">
                                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
                                </a>
                                <?php endif; ?>
                                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                                <?php 
                                     wp_nav_menu( array(
                                         'container'=> false,
                                        'theme_location'=>'primary',
                                        'menu_class' => 'hide-on-med-and-down',
                                        'walker' => new wp_materialize_navwalker()
                                    ));
                                ?>
                            </div>
                            <div class="col l3">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <?php create_materialize_submenu('primary'); ?>
                
                <div class="container">
                    <div class="header hide-on-med-and-down">
                        <div class="row">
                            <?php $lsix = ( is_active_sidebar( 'top-sidebar' ) ) ? 'l4' : 'l12'; ?>
                            <div class="col <?php echo $lsix; ?> m12 center-align" itemscope itemtype="http://schema.org/Organization" itemref="pinterestprof facebookprof twitterprof linkedinprof instagramprof">
                                
                                <?php  
                                    $logo = get_theme_mod( 'site_logo', '' );
                                    $title_option = get_theme_mod( 'site_title_option', 'text-only' );

                                    if ( $title_option == 'logo-only' && ! empty($logo) ) { ?>
                                        <div class="site-logo">
                                            <meta itemprop="name" content="<?php echo bloginfo('name'); ?>">
                                            <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                                <figure itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                                    <img itemprop="contentUrl" class="responsive-img" src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>">
                                                </figure>
                                            </a>
                                        </div>
                                    <?php } 

                                    if ( $title_option == 'text-logo' && ! empty($logo) ) { ?>
                                        <div class="site-logo">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                                <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>">
                                            </a>
                                        </div>
                                        <div class="site-title-text">
                                                <h1 class="h2" itemprop="name"><a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                                <h2 class="h5" itemprop="description"><?php bloginfo( 'description' ); ?></h2>
                                        </div>
                                    <?php } 

                                    if ( $title_option == 'text-only' ) { ?>
                                        <div class="site-title-text">
                                                <h1 class="h2" itemprop="name"><a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                                <h2 class="h5" itemprop="description"><?php 
                                                    if(empty(bloginfo( 'description' ))):
                                                       echo "&nbsp;";
                                                    else:
                                                       bloginfo( 'description' ); 
                                                    endif;
                                                ?></h2>
                                        </div>
                                <?php } ?>
                            </div>
                            <?php if ( $lsix ) : ?>
                                <div class="col l8 m12">
                                    <div class="header-ad center-align">
                                        <?php 
                                            if ( is_active_sidebar( 'top-sidebar' ) ) {
                                                dynamic_sidebar( 'top-sidebar' );
                                            } else { ?>
                                            <a href="http://qq288.com/" rel="nofollow" target="_blank">
                                                <img class="responsive-img" src="http://www.jennifer.com/wordpress/wp-content/uploads/2016/10/460-x-40-qq288-indo.gif" alt="QQ288 - Online Sports Betting, Live Casino, E-Games, Keno, Poker" title="QQ288 Asia Cash Market | Sports Betting Online | Live Casino | E-Games | Poker">
                                            </a>
                                        <?php } ?>
                                    </div><!--header ad-->
                                </div>
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>
            </header>
            
        <main class="container">