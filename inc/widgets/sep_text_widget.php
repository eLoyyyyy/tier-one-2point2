<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

class sep_text_widget extends WP_Widget{
    
    function __construct() {
        parent::__construct(
            'sep_text_widget',
            __('[TOD3] HTML Widget', 'tod3'),
            array( 'description' => __('Arbitrary HTML or text, but organized.', 'tod3'), )
        );
    }
    
    public function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $html = apply_filters( 'html', empty( $instance['html'] ) ? '' : do_shortcode( $instance['html'] ), $instance );
        $css = apply_filters( 'css', empty( $instance['css'] ) ? '' : $instance['css'], $instance );
        $js = apply_filters( 'js', empty( $instance['js'] ) ? '' : do_shortcode( $instance['js'] ), $instance );
        
        echo $before_widget;
        /*if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } */?>
            <div class="center-align">
                <?php echo $html; ?>
            </div>
            <style>
                <?php echo $css; ?>
            </style>
            <script>
                <?php echo $js; ?>
            </script>
        <?php
        echo $after_widget;
    }
    
    public function form( $instance ) {
		$instance[ 'html' ]   = isset($instance[ 'html' ]) ? $instance[ 'html' ] : '';
        $instance[ 'css' ]   = isset($instance[ 'css' ]) ? $instance[ 'css' ] : '';
        $instance[ 'js' ]   = isset($instance[ 'js' ]) ? $instance[ 'js' ] : '';
		?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id( 'html' ); ?>"><?php _e( 'HTML Content:' ); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>"><?php echo $instance['html']; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'CSS Content:' ); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('css'); ?>" name="<?php echo $this->get_field_name('css'); ?>"><?php echo esc_textarea( $instance['css'] ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'js' ); ?>"><?php _e( 'JS Content:' ); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('js'); ?>" name="<?php echo $this->get_field_name('js'); ?>"><?php echo esc_textarea( $instance['js'] ); ?></textarea>
        </p>

		<?php
	}
    
    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['html'] = $new_instance['html'];
        $instance['css'] = $new_instance['css'];
        $instance['js'] = $new_instance['js'];
		return $instance;
	}
    
    
}