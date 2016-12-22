<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

// Creating the widget 
class tonetwopointone_archive_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'tonetwopointone_archive_widget', 

            // Widget name will appear in UI
            __('[T1.2] Multi Tabbed Widget', 'tieronetwo'), 
            
            // Widget description
            array( 'description' => __( 'Recent Post, Most Viewed and Archive Widget for Tier One.2.1', 'tieronetwopointone' ), 
                    'classname'   => 'tonetwopointone_archive_widget',) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = null; $before_widget = null; $after_widget = null; 
        
        if (! empty( $instance['title'] ) ) { $title = apply_filters('widget_title', $instance['title'] ); }
        if (! empty( $args['before_widget'] ) ) { $before_widget = $args['before_widget']; }
        if (! empty( $args['after_widget'] ) ) { $after_widget = $args['after_widget']; }
                
        ?>
		<section class="section">
            <div class="section-header blue-grey darken-4 center-align">
                <?php if ( ! empty( $title ) ) : ?>
                <h1 class="h5 center-align" style="font-weight: bold"><?php echo $instance['title']; ?></h1>
                <?php endif; ?>
            </div>
            <div class="section-contentt">
                <div class="row clearfix" style="margin-bottom:0px;">
                    <div class="col s12">
                        <ul class="tabs tabs-fixed-width blue-grey darken-4">
                            <li class="tab col s3"><a class="active" href="#recent">RECENT</a></li>
                            <li class="tab col s3"><a href="#top">MOST VIEWED</a></li>
                            <li class="tab col s3"><a href="#archives">ARCHIVES</a></li>
                        </ul>
                    </div>
                    <div id="top" class="tabsed col s12">
                        <?php
                        $args = array(
                            'posts_per_page' => 5,
                            'meta_key' => 'post_views_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                        );
                        $query = new WP_Query( $args ); 
                        // 'meta_key=votes_count&orderby=meta_value_num&order=DESC&posts_per_page=10'
                        // 'meta_key=post_views_count&orderby=meta_value&order=DESC&posts_per_page=10'
                        // print_r($query);
                        ?>
                        
                        <?php if ( $query->have_posts() ) : ?>
                            <?php while( $query->have_posts() ) : $query->the_post(); ?>
                                <div class="tabbed-widget row clearfix">
                                    <div class="subsection-header col s4">
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <?php
                                            $file = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'multi_tab' ); 
                                            $anchor = get_the_title();
                                        ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" style="width:111px;height:64px;"
                                         src="<?php the_post_thumbnail_url( 'top-rated' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>">
                                            </a>
                                        <?php } else { ?>
                                        <?php
                                            $file = wp_get_attachment_image_url( get_attachment_id( get_first_image() ), 'multi_tab' ); 
                                            $anchor = get_the_title();
                                        ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" style="width:111px;height:64px;" src="<?php echo $file; ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>" />
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div class="subsection-content col s8">
                                        <h2 class="h6 bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <span style="font-size: 0.7rem"><i class="fa fa-eye"></i>&nbsp<?php echo getPostViews(get_the_ID());?></span>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; 
                         wp_reset_query();?>
                    </div>
                    <div id="recent" class="tabsed col s12">
                        <?php
                        $args = array(
                            'posts_per_page' => 5,
                        );
                        $query = new WP_Query( $args ); 
                        ?>
                        
                        <?php if ( $query->have_posts() ) : ?>
                            <?php while( $query->have_posts() ) : $query->the_post(); ?>
                                <div class="tabbed-widget row clearfix">
                                    <div class="subsection-header col s4">
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <?php
                                            $file = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'multi_tab' ); 
                                            $anchor = get_the_title();
                                        ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" style="width:111px;height:64px;"
                                         src="<?php the_post_thumbnail_url( 'top-rated' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>">
                                            </a>
                                        <?php } else { ?>
                                        <?php
                                            $file = wp_get_attachment_image_url( get_attachment_id( get_first_image() ), 'multi_tab' ); 
                                            $anchor = get_the_title();
                                        ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" style="width:111px;height:64px;" src="<?php echo $file; ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>" />
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div class="subsection-content col s8">
                                        <h2 class="h6 bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <span style="font-size: 0.7rem">Posted on <?php the_time('F j, Y') ?> by admin</span>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; 
                         wp_reset_query();?>
                    </div>
                    <div id="archives" class="tabsed col s12">
                        <ul class="archive">
                            <?php $args = array(
                                'type'            => 'monthly',
                                'limit'           => '',
                                'format'          => 'html', 
                                'before'          => '',
                                'after'           => '',
                                'show_post_count' => true,
                                'echo'            => 1,
                                'order'           => 'DESC',
                                    'post_type'     => 'post'
                            );
                            wp_get_archives( $args ); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'tieronetwo' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function tonetwopointone_archive_load_widget() {
	register_widget( 'tonetwopointone_archive_widget' );
}
add_action( 'widgets_init', 'tonetwopointone_archive_load_widget' );

function archive_list_item_filter( $link_html ) {
    $link_html = preg_replace('/<li>/i', '<li class="archive-item">', $link_html );
    return $link_html;
}

add_filter( 'get_archives_link', 'archive_list_item_filter' );