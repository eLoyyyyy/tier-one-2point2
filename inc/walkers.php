<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

class wp_materialize_navwalker extends Walker {

    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'dropdown-content',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
        // Build HTML for output.
        $output .= "\n" . $indent . ' id="nav-mobile" role="menu" class="' . $class_names . '">' . "\n";
    }
    
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $item_output = '';
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
        
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        
        /* Add active class */
        if(in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
            unset($classes['current-menu-item']);
        }
        
        /* Check for children */
        $children = get_posts(array(
            'post_type' => 'nav_menu_item',
            'nopaging' => true,
            'numberposts' => 1,
            'meta_key' => '_menu_item_menu_item_parent',
            'meta_value' => $item->ID
        ));
        if (!empty($children)) {
            $classes[] = 'dropdown';
        }
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        
        // $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        // $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        // $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output     .= $indent . '<li role="presentation" id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . '">';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ! empty( $children )         ? ' data-activates="dropdown-'. $item->ID .'" data-beloworigin="true" data-constrainwidth="false" data-alignment="right" ' : '';
        $attributes .= ! empty( $children )         ? ' class="dropdown-button black-text bold '. $depth_class_names .'"' : ' class="black-text bold '. $depth_class_names .'"';
        $item_output .= '<a itemprop="url" '. $attributes .'>';
        $item_output .= $args->link_before . '<span itemprop="name">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $args->link_after;
        
        if(!empty($children))
        $item_output .= ' <i class="material-icons right">arrow_drop_down</i>';
        $item_output .= '</a>';
        $item_output .= $args->after;
        if(!empty($children))
        $item_output .= '<ul id="dropdown-'.$item->ID.'"';
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}

class Wpse8170_Menu_Walker extends Walker_Nav_Menu {


    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a class="grey-text text-lighten-3" '. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}


function create_materialize_submenu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $bool = true;
        $menu_list = '<ul id="mobile-demo" class="side-nav" >';
        $logo = get_theme_mod('site_logo', '');
        if ( !empty($logo) ) : 
            list($width, $height, $type, $attr) = getimagesize($logo);
            $menu_list .= '<li>';
                $menu_list .= '<div class="userView" style="height:'.$height.'px;">';
                    $menu_list .= '<div class="background center-align" >';
                        $menu_list .= '<img class="responsive-img" src="'.$logo.'">';
                    $menu_list .= '</div>';
                $menu_list .= '</div>';
            $menu_list .= '</li>';
        endif; 
        
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {
                $parent = $menu_item->ID;
                $menu_array = array();
                
                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent) {
                        $bool = true;
                        $menu_array[] = '<li><a class="bold" href="' . $submenu->url . '">' . $submenu->title . '</a></li>';
                    }

                }
                
                if( $bool == true && count( $menu_array ) > 0 ) {
                     
                    $menu_list .= '<li class="no-padding">' ."\n";
                        $menu_list .= '<ul class="collapsible collapsible-accordion">' ."\n";
                            $menu_list .= '<li>' ."\n";
                            $menu_list .= '<a href="'.$menu_item->url.'" style="font-weight:bold;" class="collapsible-header">'.$menu_item->title.' <i class="fa fa-caret-down" aria-hidden="true"></i></a>';
                            $menu_list .= '<div class="collapsible-body">';
                                $menu_list .= '<ul>';
                                    $menu_list .= implode( "\n", $menu_array );
                                $menu_list .= '</ul>';
                            $menu_list .= '</div>';
                            $menu_list .= '</li>';
                        $menu_list .= '</ul>';
                    
                    $menu_list .= '</li>';
                    
                } else {
                     
                    $menu_list .= '<li><a href="' . $menu_item->url . '" class="bold">' . $menu_item->title . '</a>';
                }

            }
            
        }

        $menu_list .= '</ul>' ."\n";

    }

    echo $menu_list;
}


/* original materialized submenu walker */

/*

function create_materialize_submenu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $bool = true;
        $menu_list = '<ul id="mobile-demo" class="side-nav" >';
        
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {
                $parent = $menu_item->ID;
                $menu_array = array();

                foreach( $menu_items as $submenu ) {
                    if( $submenu->menu_item_parent == $parent) {
                        $bool = true;
                        $menu_array[] = '<li><a href="' . $submenu->url . '">' . $submenu->title . '</a></li>' .'\n';
                        $menu_array3[] = array("title"=>$submenu->title,"url"=>$submenu->url,"id"=>$submenu->ID);
                    }

                }

                if( $bool == true && count( $menu_array ) > 0 ) {
                    $menu_list .= '<li class="no-padding">' ."\n";
                        $menu_list .= '<ul class="collapsible collapsible-accordion">' ."\n";
                            $menu_list .= '<li>' ."\n";
                                $menu_list .= '<a class="collapsible-header">' . $menu_item->title . '<i class="material-icons">arrow_drop_down</i></a>' ."\n";
                                $menu_list .= '<div class="collapsible-body">' ."\n";
                                    $menu_list .= '<ul>' ."\n";

                                        foreach ($menu_array3 as $marray2) {
                                            $menu_list .= '<li class="no-padding">' ."\n";
                                                $menu_list .= '<ul class="collapsible collapsible-accordion">' ."\n";
                                                    $menu_list .= '<li>' ."\n";
                                                        $special_id = $marray2["id"];

                                                        if ($menu_item->menu_item_parent == $marray2["id"]) {
                                                            $menu_list .= '<a class="collapsible-header iconpadding">' . $marray2["title"] . '<i class="material-icons">arrow_drop_down</i></a>' ."\n";
                                                        }

                                                        else {
                                                            $menu_list .= "<li class='collapsible-title'><a href='" . $marray2["url"] . "'>" . $marray2["title"] . "</a></li>";
                                                        }

                                                        $menu_list .= '<div class="collapsible-body">' ."\n";
                                                            $menu_list .= '<ul>' ."\n";

                                                                foreach ($menu_items as $menu_item) {
                                                                    if ($menu_item->menu_item_parent == $marray2["id"]) {
                                                                        $menu_list .= "<li class='collapsible-title'><a href='" . $menu_item->url . "'>" . $menu_item->title . "</a></li>";
                                                                    }
                                                                }
                                                            $menu_list .= '</ul>' ."\n";
                                                        $menu_list .= '</div>' ."\n";
                                                    $menu_list .= '</li>' ."\n";
                                                $menu_list .= '</ul>' ."\n";
                                            $menu_list .= '</li>' ."\n";

                                            if ($special_id == $marray2["id"]) {
                                                // do nothing
                                            }
                                            else {
                                                $menu_list .= "<li><a href='" . $marray2["url"] . "'>" . $marray2["title"] . "</a></li>";
                                            }
                                        }

                                    $menu_list .= '</ul>' ."\n";
                                $menu_list .= '</div>' ."\n";
                            $menu_list .= '</li>' ."\n";
                        $menu_list .= '</ul>' ."\n";

                } 

                else {
                    $menu_list .= '<li>' ."\n";
                    $menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>' ."\n";
                }

            }
        }

        $menu_list .= '</ul>' ."\n";

    } 

    else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }

    echo $menu_list;
}

*/