<?php

class tod3_show_post extends WP_Widget {
    public function  __construct(){
        parent::__construct(
            'tod3_show_post',
            __('[TOD3] Show Post', 'tod3'),
            array(
                'description'   => __('Show Post Widget','tod3')
            )
        );
    }
 
    public function widget($args,$instance){
        global $post;
        $title      = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $category       = isset( $instance[ 'categories' ] ) ? $instance[ 'categories' ] : array();
        $no_of_post         = isset( $instance[ 'no_of_post' ] ) ? $instance[ 'no_of_post' ] : '';
        $random_posts       = isset( $instance[ 'random_posts' ] ) ? $instance[ 'random_posts' ] : '';
        $layout = isset( $instance[ 'layout' ] ) ? $instance[ 'layout' ] : '';
        $radio_buttons = isset( $instance[ 'radio_buttons' ] ) ? $instance[ 'radio_buttons' ] : ''; 
        
        extract( $args );
 
        if ( $random_posts == "on") {
            $random_posts = "rand";
        }
        
        $if_cat = !empty( $category ) ? array( 'category__in' => $category ) : array();
 
        $layoutc = new WP_Query( array_merge( array(
            'post_type'      => 'post',
            'posts_per_page' => $no_of_post,
            'orderby'        => $random_posts
            ), $if_cat ) );
        
        echo $before_widget;
                if ( ! empty($title) ) { 
                    echo $before_title . esc_html( $title ) . $after_title;
                } ?>
            <div class="section-content">
                <?php
                    if ( $layoutc->have_posts() ) :
                        while ( $layoutc->have_posts() ) : $layoutc->the_post();
                    
                        switch ( $radio_buttons ) {
                            case "layout_1": ?>
                                <div class="card">
                                    <div class="card-content clearfix">
                                        <figure class="card-img">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image(); ?>
                                                <img class="responsive-img soft-crop hide-on-xl-and-down" style="width:100%; height:94px;" src="<?php echo $file; ?>" alt="<?php the_title(); ?>" />
                                            </a>
                                        </figure>
                                        <div class="card-ttle">
                                            <h1>
                                                <a href="<?php echo esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php echo the_title(); ?></a>
                                            </h1>
                                            <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#!"><?php echo $post->comment_count; ?></a>
                                            <i class="fa fa-eye" aria-hidden="true"></i><a href="#!"><?php echo getPostViews(get_the_ID()); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php break;
                            case "layout_2": ?>
                                <div class="card">
                                    <div class="card-content center">
                                        <figure class="imghvr-push-up">
                                            <?php $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image(); ?>
                                            <img class="soft-crop" src="<?php echo $file; ?>">
                                            <figcaption>
                                                <h1 class="h6"><?php the_title(); ?></h1>
                                            </figcaption>
                                            <a href="<?php the_permalink(); ?>"></a>
                                        </figure>
                                    </div>
                                </div>
                                <?php break;
                            case "layout_3": ?>
                                <div class="card">
                                    <div class="card-image">
                                        <?php $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?: get_first_image(); ?>
                                        <img class="responsive-img" src="<?php echo $file; ?>">
                                    </div>
                                    <div class="card-content">
                                        <h1 class="h6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                    </div>
                                    <div class="card-action">
                                        <span style="font-size:0.8rem">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                            <?php the_time('F j, Y h:s a', '<a class="black-text" href="#!">', '</a>'); ?>
                                        </span>
                                    </div>
                                </div>
                                <?php break;
                                
                        }
                    ?>
                    <?php      
                        endwhile;
                    else:?>
                        <p><?php _e('Sorry, no posts found in selected category','tierone'); ?></p>
                <?php endif; wp_reset_query(); ?>
            </div>
        <?php
        echo $after_widget;
    }
 
    public function form($instance){
        $instance = wp_parse_args(
            (array) $instance, array(
                'title'          => '',
                'post_type'          => '',
                'categories'           => array(),
                'no_of_post'         => '6',
                'random_posts'       => '',
                'layout'             => 0,
                'radio_buttons'      => '',
            )
        );
        ?>
        <div class="dt-tierone-layout-3">
            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id('title')?>"><?php _e('Title:','tierone');?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" >
            </p><!-- .dt-admin-input-wrap -->
            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Select a post category', 'tod3' ); ?></label>
                <select name="<?php echo $this->get_field_name( 'categories' ); ?>[]" class="widefat" size="6" multiple>
                    <?php
                    $args = array( "hide_empty" => 0, "type" => "post" );
                    $categories = get_categories( $args );
                    echo '<option value="">Show all</option>';
                    foreach ( $categories as $category ) {
                        echo '<option value="' . $category->term_id . '" ' . selected( in_array($category->cat_ID, $instance['categories']) ) . '>' . $category->name . '</option>';
                    }
                    ?>   
                </select>
            </p><!-- .dt-admin-input-wrap -->
            <p class="dt-admin-input-wrap">
                <input class="checkbox" type="checkbox" <?php checked( $instance[ 'random_posts' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'random_posts' ); ?>" name="<?php echo $this->get_field_name( 'random_posts' ); ?>" />
                <label for="<?php echo $this->get_field_id('random_posts')?>"><?php _e('Random Posts','tierone');?></label>
            </p><!-- .dt-admin-input-wrap -->
            <p class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'no_of_post' ); ?>"><?php _e( 'Number of posts', 'tierone' ); ?></label>
                <input class="tiny-text" type="number" id="<?php echo $this->get_field_id( 'no_of_post' ); ?>" name="<?php echo $this->get_field_name( 'no_of_post' ); ?>" value="<?php echo esc_attr( $instance['no_of_post'] ); ?>">
            </p><!-- .dt-admin-input-wrap -->
            <p>
                <label for="<?php echo $this->get_field_id('radio_buttons'); ?>">
                    <?php _e('Layout 1:'); ?>
                    <input class="layout layout_1" data-preview-img="<?php echo get_stylesheet_directory_uri() ;?>/images/layout-1.png" id="<?php echo $this->get_field_id('layout_1'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="layout_1" <?php if($instance['radio_buttons'] === 'layout_1'){ echo 'checked="checked"'; } ?> />
                </label>
                <label for="<?php echo $this->get_field_id('radio_buttons'); ?>">
                    <?php _e('Layout 2:'); ?>
                    <input class="layout layout-2" data-preview-img="<?php echo get_stylesheet_directory_uri() ;?>/images/layout-2.png" id="<?php echo $this->get_field_id('layout_2'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="layout_2" <?php if($instance['radio_buttons'] === 'layout_2'){ echo 'checked="checked"'; } ?> />
                </label>
                <label for="<?php echo $this->get_field_id('radio_buttons'); ?>">
                    <?php _e('Layout 3:'); ?>
                    <input class="layout layout-3" data-preview-img="<?php echo get_stylesheet_directory_uri() ;?>/images/layout-3.png" id="<?php echo $this->get_field_id('layout_3'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="layout_3" <?php if($instance['radio_buttons'] === 'layout_3'){ echo 'checked="checked"'; } ?> />
                </label>
            </p>
            <p>
                <?php if ( $instance['radio_buttons'] == "layout_1" ) : ?>
                    <img id="preview" src="<?php echo get_stylesheet_directory_uri()  . "/images/layout-1.png"; ?>">
                <?php elseif ( $instance['radio_buttons'] == "layout_2" ) : ?>
                    <img id="preview" src="<?php echo get_stylesheet_directory_uri()  . "/images/layout-2.png"; ?>">
                <?php elseif ( $instance['radio_buttons'] == "layout_3" ) : ?>
                    <img id="preview" src="<?php echo get_stylesheet_directory_uri()  . "/images/layout-3.png"; ?>">
                <?php endif; ?>
            </p>
        </div>
 
        <?php
 
    }
 
    public function update($new_instance, $old_instance){
        return array(
            'title' => isset($new_instance['title']) ? strip_tags($new_instance['title']) : $old_instance['title'],
            'random_posts' => $new_instance['random_posts'],
            'categories' => isset($new_instance['categories']) ? array_filter(array_map(function($id) { return intval($id); }, (array) $new_instance['categories'])) : (array) $old_instance['categories'],
            'no_of_post' => strip_tags( stripslashes( $new_instance['no_of_post'] ) ),
            'radio_buttons' => strip_tags($new_instance['radio_buttons']),
        );
    }
}