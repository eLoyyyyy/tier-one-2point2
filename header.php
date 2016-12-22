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
            </div>
            
        <main class="outer-container">
            <div class="container">
            
                <header class="header hide-on-med-and-down">
                    <div class="row flexbox-container">
                        <?php $lsix = ( is_active_sidebar( 'horizontal-ad-head' ) ) ? 'l3' : 'l12'; ?>
                        <div class="col <?php echo $lsix; ?> m12 center-align">
                            <?php  
                                $logo = get_theme_mod( 'site_logo', '' );
                                $title_option = get_theme_mod( 'site_title_option', 'text-only' );

                                if ( $title_option == 'logo-only' && ! empty($logo) ) { ?>
                                    <div class="site-logo">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                            <img class="responsive-img" src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>">
                                        </a>
                                    </div>
                                <?php } 

                                if ( $title_option == 'text-logo' && ! empty($logo) ) { ?>
                                    <div class="site-logo">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"></a>
                                    </div>
                                    <div class="site-title-text">
                                            <h1 class="h2" itemprop="headline"><a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                            <h2 class="h6" itemprop="description"><?php bloginfo( 'description' ); ?></h2>
                                    </div>
                                <?php } 

                                if ( $title_option == 'text-only' ) { ?>
                                    <div class="site-title-text">
                                            <h1 class="h2" itemprop="headline"><a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                            <h2 class="h6" itemprop="description"><?php 
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
                            <div class="col l9 m12">
                                <div class="header-ad" style="margin-top:-20px;">
                                    <?php dynamic_sidebar( 'horizontal-ad-head' ); ?> 
                                </div><!--header ad-->
                            </div>
                        <?php endif; ?> 
                    </div>
                </header>
            </div>
                
                <nav class="main-nav white z-depth-0 nav-fixed white" itemscope itemtype="http://schema.org/SiteNavigationElement">
                    <div class="container">
                        <div class="nav-wrapper">
                            <?php $logo = get_theme_mod( 'site_logo', '' );
                            if ( !empty($logo) ) : ?>
                            <a href="<?php echo home_url(); ?>" class="brand-logo hide-on-large-only black-text">
                                <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" style="width:208px;height:64px"/>
                            </a>
                            <?php endif; ?>
                            <a href="#" data-activates="mobile-demo" class="button-collapse black-text"><i class="material-icons">menu</i></a>
                            <?php 
                                 wp_nav_menu( array(
                                     'container'=> false,
                                    'theme_location'=>'primary',
                                    'menu_class' => 'hide-on-med-and-down',
                                    'walker' => new wp_materialize_navwalker()
                                ));
                            ?>
                        </div>
                    </div>
                </nav>
                <!--<ul id="mobile-demo" class="side-nav">
                    <li><a href="#!" class="bold">First Sidebar Link</a></li>
                    <li><a href="#!" class="bold">Second Sidebar Link</a></li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header bold" >Dropdown</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="#!">First</a></li>
                                        <li><a href="#!">Second</a></li>
                                        <li><a href="#!">Third</a></li>
                                        <li><a href="#!">Fourth</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>-->
                <?php create_materialize_submenu('primary'); ?>
            <?php if ( is_404() ) : ?>
            <div class="row clearfix error-image">
                <div class="col l12 m12 s12">
                    <img class="responsive-img four-o-four" src="<?php echo get_stylesheet_directory_uri() . '/images/error-404.png'; ?>" style="position: absolute; left: 0;">
                </div>
            </div>
            <?php endif; ?>
            <div class="container">