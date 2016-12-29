<?php

class ads_widget extends WP_Widget {

	function __construct() {
        parent::__construct(
            // Base ID of your widget
            'ads_widget', 
            // Widget name will appear in UI
            __('[TOD3] Banner Ad', 'tod3'), 

            // Widget description
            array( 'description' => __( 'Add your Advertisement here', 'tod3' ), ) 
        );
    }

  public function widget($args, $instance){
      
        extract( $args );

        $title = isset( $instance['title']) ?  apply_filters('widget_title', $instance['title']) : '' ;
        $linkads = isset( $instance['linkads']) ?   $instance['linkads'] : '' ; 
        $imgads = isset( $instance['imgads']) ?   $instance['imgads'] : '' ; 
        $blnk = isset( $instance[ 'blnk' ] ) ? $instance[ 'blnk' ] ? 'true' : 'false' : '' ;  
        $follow = isset( $instance['follow']) ?   $instance['follow'] : '' ; 
        $titleimg  =  isset( $instance['titleimg']) ?   $instance['titleimg']  : '' ; 
        $custom_class = isset( $instance['custom_class']) ?   $instance['custom_class'] : '' ; 
        $custom_css  =  isset( $instance['custom_css']) ?   $instance['custom_css']  : '' ;
        $custom_html  =  isset( $instance['custom_html']) ?   $instance['custom_html']  : '' ;
     
        echo $before_widget;     
        ?>
        
        <section class="row clearfix">
            <div class="col l12 m12 s12 center-align">
            <?php if ( $title ) : ?>
                <h1 class="sr-only"><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php $linkads = do_shortcode($linkads); ?>
                <figure>
                    <a class="unblock-trigger" href="<?php echo $linkads; ?>" target="<?php echo ($blnk == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow ?>">
                        <img class="<?php echo $custom_class; ?>" src="<?php echo $imgads; ?>" title="<?php echo $titleimg; ?>" alt="<?php echo $titleimg; ?>">
                    </a>
                    
                    <style>
                        <?php echo $custom_css; ?>
                    </style>
                    <?php echo $custom_html; ?>
                    <figcaption class="ad-sign">Advertisement</figcaption>
                </figure>
            
            </div>
        </section>

        <?php
      
        echo $after_widget;
    }


     public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance                   = $old_instance;
        $instance['title']          = isset($instance[ 'title' ]) ? strip_tags( $new_instance['title'] ) : '' ;
        $instance['linkads']        = isset($instance[ 'linkads' ]) ? strip_tags( $new_instance['linkads'] ) : '' ; 
        $instance['imgads']         = isset($instance[ 'imgads' ]) ? strip_tags( $new_instance['imgads'] ) : '' ; 
        $instance['blnk']           = isset($instance[ 'blnk' ]) ? strip_tags( $new_instance['blnk'] ) : '' ;
        $instance['follow']         = isset($instance[ 'follow' ]) ? strip_tags( $new_instance['follow'] ) : '' ; 
        $instance['titleimg']       = isset($instance[ 'titleimg' ]) ? strip_tags( $new_instance['titleimg'] ) : '' ; 
        $instance['custom_class']         = isset($instance[ 'custom_class' ]) ? strip_tags( $new_instance['custom_class'] ) : '' ; 
        $instance['custom_css']       = isset($instance[ 'custom_css' ]) ? strip_tags( $new_instance['custom_css'] ) : '' ; 
        $instance['custom_html']       = isset($instance[ 'custom_html' ]) ?  $new_instance['custom_html'] : '' ; 
        return $instance;
     }

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

    public function form( $instance ) {


                $instance[ 'title' ]      = isset($instance[ 'title' ]) ? esc_attr( $instance[ 'title' ] ) : '';
                $instance[ 'linkads' ]    = isset($instance[ 'linkads' ]) ? esc_attr( $instance[ 'linkads' ] ) : ''; 
                $instance[ 'imgads' ]     = isset($instance[ 'imgads' ]) ? esc_attr( $instance[ 'imgads' ] ) : ''; 
                $instance[ 'blnk' ]       = isset($instance[ 'blnk' ]) ? esc_attr( $instance[ 'blnk' ] ) : ''; 
                $instance[ 'follow' ]    = isset($instance[ 'follow' ]) ? esc_attr( $instance[ 'follow' ] ) : ''; 
                $instance[ 'titleimg' ]   = isset($instance[ 'titleimg' ]) ? esc_attr( $instance[ 'titleimg' ] ) : '';
                $instance[ 'custom_class' ]    = isset($instance[ 'custom_class' ]) ? esc_attr( $instance[ 'custom_class' ] ) : ''; 
                $instance[ 'custom_css' ]   = isset($instance[ 'custom_css' ]) ? esc_attr( $instance[ 'custom_css' ] ) : '';
                $instance[ 'custom_html' ]   = isset($instance[ 'custom_html' ]) ? $instance[ 'custom_html' ] : '';


            // Widget admin form
    /*----------------------------------------------------------------------------------------------------------
      Widget Options
    -----------------------------------------------------------------------------------------------------------*/
    ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', '[Tier One] Promo Ads' ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </p>

             <!--  Banner Promo Ads -->   

            <h3><?php _e( 'Banner Ad', '[Tier One] Promo Ads 720x90' ); ?></h3>
            <h4><?php _e( 'Using image:', '[Tier One] Promo Ads 720x90' ); ?></h4>
            <p>
                <label for="<?php echo $this->get_field_id( 'imgads' ); ?>"><?php _e( 'Image Url:', '[Tier One] Promo Ads 720x90' ); ?></label>
                <img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ 'imgads' ] ); ?>" style="max-width:100%;" />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads' ); ?>" name="<?php echo $this->get_field_name( 'imgads' ); ?>" value="<?php echo $instance['imgads']; ?>" />
                <input type="button" class="dt-img-upload dt-custom-media-button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads' ); ?>" value="<?php _e( 'Upload Image', '[Tier One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads' ); ?>' ); return false;"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'titleimg' ); ?>"><?php _e( 'Anchor Title:', '[Tier One] Promo Ads 720x90' ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg' ); ?>" name="<?php echo $this->get_field_name( 'titleimg' ); ?>" value="<?php echo $instance['titleimg']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'linkads' ); ?>"><?php _e( 'Target Url:', '[Tier One] Promo Ads 720x90' ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads' ); ?>" name="<?php echo $this->get_field_name( 'linkads' ); ?>" value="<?php echo $instance['linkads']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'follow' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier One] Promo Ads 720x90' ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow' ); ?>" name="<?php echo $this->get_field_name( 'follow' ); ?>" value="<?php echo $instance['follow']; ?>" />
            </p>
            <p>
                <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk' ); ?>" name="<?php echo $this->get_field_name( 'blnk' ); ?>" <?php checked( $instance[ 'blnk' ], 'on' ); ?> >
                <label for="<?php echo $this->get_field_id( 'blnk' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier One] Promo Ads' ); ?></label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom CSS Classes', '[Tier One] Promo Ads' ); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" value="<?php echo $instance['custom_class']; ?>">
                <span class="description">Classes are separated by spaces.</span>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'custom_css' ); ?>"><?php _e( 'Custom CSS', 'tod3' ); ?></label>
                <textarea onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" class="widefat" id="<?php echo $this->get_field_id( 'custom_css' ); ?>" rows="5" cols="20" name="<?php echo $this->get_field_name( 'custom_css' ); ?>" ><?php echo $instance['custom_css']; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'custom_html' ); ?>"><?php _e( 'Custom HTML', 'tod3' ); ?></label>
                <textarea onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" class="widefat" id="<?php echo $this->get_field_id( 'custom_html' ); ?>" rows="5" cols="20" name="<?php echo $this->get_field_name( 'custom_html' ); ?>" ><?php echo $instance['custom_html']; ?></textarea>
            </p>


            <script>
                    imageWidget = {
                        uploader : function( widget_id_string ) {

                            function media_upload(button_class) {
                                var _custom_media = true,
                                _orig_send_attachment = wp.media.editor.send.attachment;

                                jQuery('body').on('click', button_class, function(e) {
                                    var button_id ='#'+jQuery(this).attr('id');
                                    var self = jQuery(button_id);
                                    var send_attachment_bkp = wp.media.editor.send.attachment;
                                    var button = jQuery(button_id);
                                    var id = button.attr('id').replace('_button', '');
                                    _custom_media = true;
                                    wp.media.editor.send.attachment = function(props, attachment){
                                        if ( _custom_media  ) {

                                           jQuery("#" + widget_id_string ).val(attachment.url);   

                                        } else {
                                            return _orig_send_attachment.apply( button_id, [props, attachment] );
                                        }
                                    }
                                    wp.media.editor.open(button);
                                        return false;
                                });
                            }
                            media_upload('.custom_media_button.button');
                        }
                    }
                </script>

    <?php 
    }
}