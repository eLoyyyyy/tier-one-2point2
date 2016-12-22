<?php




function tierone_media_scripts( $hook ){
 if ( 'widgets.php' != $hook) {
  return;
 }
 wp_enqueue_style( 'wp-color-picker' );

 //Update Style with in the admin
 wp_enqueue_style( 'tierone-widgets', get_template_directory_uri() . '/inc/widgets/widgets.css');

 wp_enqueue_media();
 wp_enqueue_script( 'wp-color-picker' );
 wp_enqueue_script( 'tierone-media-upload', get_template_directory_uri() . '/inc/widgets/widgets.js', array('jquery'), ' ' , true);
}
add_action( 'admin_enqueue_scripts', 'tierone_media_scripts');



/*function wp_gear_manager_admin_scripts() {
    wp_enqueue_media();
}

function wp_gear_manager_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');*/


 
// //////////////////////////////////////////////////
//                                                 //
//             Advertisement 7200x900              //
//                                                 //
/////////////////////////////////////////////////////

class ads_720x90_widget extends WP_Widget {

	function __construct() {
        parent::__construct(
            // Base ID of your widget
            'ads_720x90_widget', 
            // Widget name will appear in UI
            __('[Tier One] Promo Ads 720x90', 'ads_720x90_widget'), 

            // Widget description
            array( 'description' => __( 'Add your Advertisement here', 'ads_720x90_widget' ), ) 
        );
    }

  public function widget($args, $instance){

        $title = isset( $instance['title']) ?  apply_filters('widget_title', @$instance['title']) : '' ;
        $linkads = isset( $instance['linkads']) ?   $instance['linkads'] : '' ; 
        $imgads = isset( $instance['imgads']) ?   $instance['imgads'] : '' ; 
        $blnk = isset( $instance[ 'blnk' ] ) ? $instance[ 'blnk' ] ? 'true' : 'false' : '' ;  
        $follow = isset( $instance['follow']) ?   $instance['follow'] : '' ; 
        $titleimg  =  isset( $instance['titleimg']) ?   $instance['titleimg']  : '' ; 
     
        echo @$before_widget;     
?>
        <section class="section col s12 center-align">
        <?php if ( $title ) : ?>
            <h1 class="sr-only"><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php
        if( @$linkads || @$imgads ) {
            if( @$imgads ) {
                $linkads = do_shortcode($linkads);
            ?>
                <a href="<?php echo $linkads; ?>" target="<?php echo ($blnk == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow ?>"><img class="responsive-img" src="<?php echo $imgads; ?>" title="<?php echo $titleimg; ?>" alt="<?php echo $titleimg; ?>" style="width:720px; height:90px;"/></a>     
            <?php
            }
        } ?>

        </section>

    <?php
      
        echo @$after_widget;
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

   
        // Widget admin form
/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', '[Tier One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo @$instance['title']; ?>" />
        </p>

         <!--  Banner Promo Ads -->   

        <h3><?php _e( 'Promo Banner Ads 720x90', '[Tier One] Promo Ads 720x90' ); ?></h3>
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


}//end of widget class


// //////////////////////////////////////////////////
//                                                 //
//             Advertisement 300x300               //
//                                                 //
/////////////////////////////////////////////////////

class ads_300x300_widget extends WP_Widget {

	function __construct() {
        parent::__construct(
            // Base ID of your widget
            'ads_300x300_widget', 
            // Widget name will appear in UI
            __('[Tier One] Promo Ads 300x300', 'ads_300x300_widget'), 

            // Widget description
            array( 'description' => __( 'Add your Advertisement here', 'ads_300x300_widget' ), ) 
        );
    }

  public function widget($args, $instance){

        $title = isset( $instance['title']) ?  apply_filters('widget_title', @$instance['title']) : '' ;
        $linkads = isset( $instance['linkads']) ?   $instance['linkads'] : '' ; 
        $imgads = isset( $instance['imgads']) ?   $instance['imgads'] : '' ; 
        $blnk = isset( $instance[ 'blnk' ] ) ? $instance[ 'blnk' ] ? 'true' : 'false' : '' ;  
        $follow = isset( $instance['follow']) ?   $instance['follow'] : '' ; 
        $titleimg  =  isset( $instance['titleimg']) ?   $instance['titleimg']  : '' ; 
     
        echo @$before_widget;     
?>

        <section class="section">
            <?php if ( $title ) : ?>
            <div class="section-header blue-grey darken-4 center-align">
                <h1 class="h5"><?php echo @$title; ?></h1>
            </div>
            <?php endif; ?>
            <div class="section-contentt">
                <div class="videos row clearfix">
                    <div class="col l12 m12 s12 center-align">
                        <?php if( @$linkads || @$imgads ) { ?>
                            <?php if( @$imgads ) { ?>
                            <a href="<?php echo $linkads; ?>" target="<?php echo ($blnk == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow ?>">
                                <img src="<?php echo $imgads; ?>" title="<?php echo $titleimg; ?>" alt="<?php echo $titleimg; ?>" class="responsive-img" style="width:300px;"/>
                            </a>   
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

    <?php
      
        echo @$after_widget;
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

   
        // Widget admin form
/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', '[Tier One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo @$instance['title']; ?>" />
        </p>

         <!--  Banner Promo Ads -->   

        <h3><?php _e( 'Promo Banner Ads 300x300', '[Tier One] Promo Ads 300x300' ); ?></h3>
        <h4><?php _e( 'Using image:', '[Tier One] Promo Ads 300x300' ); ?></h4>
        <p>
        <label for="<?php echo $this->get_field_id( 'imgads' ); ?>"><?php _e( 'Image Url:', '[Tier One] Promo Ads 300x300' ); ?></label><br>
        <img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ 'imgads' ] ); ?>" style="max-width:50%;" />
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads' ); ?>" name="<?php echo $this->get_field_name( 'imgads' ); ?>" value="<?php echo $instance['imgads']; ?>" />
        <input type="button" class="dt-img-upload dt-custom-media-button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads' ); ?>" value="<?php _e( 'Upload Image', '[Tier One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads' ); ?>' ); return false;"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'titleimg' ); ?>"><?php _e( 'Anchor Title:', '[Tier One] Promo Ads 300x300' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg' ); ?>" name="<?php echo $this->get_field_name( 'titleimg' ); ?>" value="<?php echo $instance['titleimg']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkads' ); ?>"><?php _e( 'Target Url:', '[Tier One] Promo Ads 300x300' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads' ); ?>" name="<?php echo $this->get_field_name( 'linkads' ); ?>" value="<?php echo $instance['linkads']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'follow' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier One] Promo Ads 300x300' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow' ); ?>" name="<?php echo $this->get_field_name( 'follow' ); ?>" value="<?php echo $instance['follow']; ?>" />
        </p>
        <p>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk' ); ?>" name="<?php echo $this->get_field_name( 'blnk' ); ?>" <?php checked( $instance[ 'blnk' ], 'on' ); ?> >
        <label for="<?php echo $this->get_field_id( 'blnk' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier One] Promo Ads' ); ?></label>
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


}//end of widget class


// //////////////////////////////////////////////////
//                                                 //
//             Advertisement 150x150               // 
//             multiple advertisement              //
//                                                 //
/////////////////////////////////////////////////////




class ads_150x150_multiple_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'ads_150x150_multiple_widget', 
            // Widget name will appear in UI
            __('[Tier One] Promo Ads 150x150 Multiple', 'ads_150x150_multiple_widget'), 

            // Widget description
            array( 'description' => __( 'Add your Advertisement here', 'ads_150x150_multiple_widget' ), ) 
        );
    }


      public function widget($args, $instance){

        $title = apply_filters('widget_title', $instance['title']);

     $instance[ 'title' ]      = isset($instance[ 'title' ]) ?  $instance[ 'title' ]  : '';
    $instance[ 'linkads' ]    = isset($instance[ 'linkads' ]) ?  $instance[ 'linkads' ]  : ''; 
    $instance[ 'imgads' ]     = isset($instance[ 'imgads' ]) ?  $instance[ 'imgads' ]  : ''; 
    $instance[ 'blnk' ]       = isset($instance[ 'blnk' ]) ?  $instance[ 'blnk' ]  : ''; 
    $instance[ 'follow' ]    = isset($instance[ 'follow' ]) ?  $instance[ 'follow' ]  : ''; 
    $instance[ 'titleimg' ]   = isset($instance[ 'titleimg' ]) ?  $instance[ 'titleimg' ]  : '';
    $instance[ 'titleimg' ]   = isset($instance[ 'titleimg' ]) ?  $instance[ 'titleimg' ]  : '';
    $instance[ 'titleads' ]   = isset($instance[ 'titleads' ]) ?  $instance[ 'titleads' ]  : '';
    

        echo @$before_widget;     
?>

        <section class="section">
            <?php if ( $title ) : ?>
            <div class="section-header blue-grey darken-4 center-align" style="text-transform:uppercase">
                <h1 class="h5"><?php echo $title; ?></h1>
            </div>
            <?php endif; ?>
            
            <div class="section-contentt">
                <div class="row clearfix center-align">
                    <?php foreach(@$instance['ads'] as $ind => $ad) : ?>
                    <?php $blk = $ad['blk'] ? 'true' : 'false';
                    $link = do_shortcode($ad['link']);?>
                    <div class="col l6 m4 s6 ads">
                        <a href="<?php echo $link; ?>" target="<?php echo ($blk == 'true' ? '_blank' : ''); ?>" rel="<?php echo $ad['fllw'] ?>"><img class="responsive-img" src="<?php echo $ad['img']; ?>" title="<?php echo $ad['timg']; ?>" alt="<?php echo $ad['timg']; ?>"/></a>
                    </div>
                    <!--<div class="col l6 m4 s12 ads">
                        <img class="responsive-img" src="http://placehold.it/201x201">
                    </div> style="width:201px;height:201px"  -->
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php
        echo @$after_widget;
    }



     public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
       

    $instance['linkads'] = ( ! empty( $new_instance['linkads'] ) ) ? strip_tags( $new_instance['linkads'] ) : '';

        // $instance['linkads']        = $new_instance['linkads'];
        // $instance['imgads']         = $new_instance['imgads'];
        // $instance['blnk']           = $new_instance[ 'blnk' ] ;
        // $instance['follow']         = $new_instance['follow'];sz
        // $instance['titleads']       = $new_instance['titleads'];
        // $instance['titleimg']       = $new_instance['titleimg'];
       

        $instance['ads'] = array();

         if(!empty($new_instance['imgads']) && !empty($new_instance['linkads']) ){
             for($i=0; $i < (count($new_instance['imgads'])); $i++){
                 if(!empty($new_instance['imgads'][$i]) && !empty($new_instance['linkads']) ){
                     $ad = array();

                     if(!empty($new_instance['imgads1'])){

                       $imgads =  esc_url($new_instance['imgads']);

                     }else{

                       $imgads  = esc_url($new_instance['imgads'][$i]);
                        
                     }

                        $ad['img'] =  $imgads;
                        $ad['link'] = $new_instance['linkads'][$i];
                        $ad['blk'] = $new_instance['blnk'][$i];
                        $ad['fllw'] = $new_instance['follow'][$i];
                        $ad['tads'] = $new_instance['titleads'][$i];
                        $ad['timg'] = $new_instance['titleimg'][$i];
                        $instance['ads'][] = $ad;

                }
            }   
        }

        return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {

     

    $instance = wp_parse_args(
        (array) $instance, array(
            'title'             => '',
            'linkads'          => '',
            'imgads'          => '',
            'blnk'          => '',
            'follow'          => '',
            'titleads'          => '',
            'titleimg'          => ''
        )
    );

        // Widget admin form
/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <!-- INSERT AND REMOVE CONTROLL -->
        <div id="control">
        <p>Number of Banner Ads to slide (max.6)</p>
        <button id="btAdd" class="btn btn-primary" type="button">
            Add<span class="glyphicon glyphicon-plus"></span>
        </button>
        <button id="btRemove" class="btn btn-danger" type="button" >
            Remove<span class="glyphicon glyphicon-minus"></span>
        </button>  
        </div>

        <hr>
            <p>
        



        <!-- Accordion-->
        <div id="accordionArray">
                <?php $add = 0; ?>    
                <?php foreach($instance['ads'] as $ad) : ?>
                <?php $add++; ?>
      
                <div id="tb<?php echo $add; ?>" >                      
                     
                   <!-- <button id='tb' class='accordion'></button> -->
                   <button id="tb" class="accordion"><label for="<?php  $this->get_field_id( 'bannertitle'  ); ?>"><?php _e('Banner Promo Ads' , '[Tier-One] Promo Ads' ); ?><?php echo $add; ?></label></button>
                    <div class='panel show'>                      
                    <p>
                    <label for="<?php echo $this->get_field_id( 'titleads' ); ?>"><?php _e( 'Title Promo Ads:', '[Tier-One] Promo Ads' ); ?></label>
                    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleads' ); ?>[]" name="<?php echo $this->get_field_name( 'titleads' ); ?>[]" value="<?php echo $ad['tads']; ?>" />
                    </p>
                    <p>
                    <label for="<?php echo $this->get_field_id( 'imgads' ); ?>"><?php _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>
                    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads' ); ?>[]" name="<?php echo $this->get_field_name( 'imgads' ); ?>[]" value="<?php echo $ad['img']; ?>" />
                    
                    <input type="button" class="dt-img-upload dt-custom-media-button" id="custom_media_button" name="<?php echo $this->get_field_name( 'imgads' ); ?>" value="<?php _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads' ); ?>'  ); return false;"/>    
                    </p>
                    <p>
                    <label for="<?php echo $this->get_field_id( 'titleimg' ); ?>"><?php _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>
                    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg' ); ?>[]" name="<?php echo $this->get_field_name( 'titleimg' ); ?>[]" value="<?php echo $ad['timg']; ?>" />
                    </p>
                    <p>
                    <label for="<?php echo $this->get_field_id( 'linkads' ); ?>"><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>
                    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads' ); ?>[]" name="<?php echo $this->get_field_name( 'linkads' ); ?>[]" value="<?php echo $ad['link']; ?>" />
                    </p>
                    <p>
                    <label for="<?php echo $this->get_field_id( 'follow' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>
                    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow' ); ?>[]" name="<?php echo $this->get_field_name( 'follow' ); ?>[]" value="<?php echo  $ad['fllw']; ?>" />
                    </p>
                    <p>
                    <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk' ); ?>[]" name="<?php echo $this->get_field_name( 'blnk' ); ?>[]" <?php checked($ad['blk'], 'on' ); ?> >
                    <label for="<?php echo $this->get_field_id( 'blnk' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>
                    </p>

                    </div>
                </div>

                  <?php endforeach; ?> 

        </div>

        
          <script>

        var iCnt = <?php echo $add; ?>;
        // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.

       jQuery('button#btAdd').on('click', function(){

          if (iCnt <=12) {

            iCnt++;
            console.log(iCnt);


          imgval = "<?= $this->get_field_name( 'imgads' ); ?>";
          console.log(imgval);

           toappend = "<div id=tb"+iCnt+">"                      
                    +"<button id='tb' class='accordion'><label for='<?=  $this->get_field_id( 'bannertitle'  ); ?>'><?= _e('Banner Promo Ads' , '[Tier-One] Promo Ads' ); ?>&nbsp;"+ iCnt +"</label></button>" 
                    +"<div class='panel'>"   
                    +"<p>"
                    +"<label for='<?=  $this->get_field_id( 'titleads' ); ?>''><?= _e( 'Title Promo Ads:', '[Tier-One] Promo Ads' ); ?></label>"
                    +"<input class='widefat' type='text' id='<?=  $this->get_field_id( 'titleads' ); ?>[]' name='<?=  $this->get_field_name( 'titleads' ); ?>[]' value='<?=  $instance['titleads']; ?>' />"
                    +"</p>"             
                    +"<h4>Using image: </h4>"
                    +"<p>"
                    +"<label for='<?=  $this->get_field_id( 'imgads'  ); ?>'><?= _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>"
                    +"<input class='widefat' type='text' id='<?=  $this->get_field_id( 'imgads' ); ?>[]' name='<?=  $this->get_field_name( 'imgads' ); ?>[]' value='<?=  $instance['imgads'];?>' />"
                    +"<input type='button' class='dt-img-upload dt-custom-media-button' id='custom_media_button' name='<?= $this->get_field_name( "imgads" ); ?>[]' value='<?= _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>' onclick='imageUploader(\"" + imgval + "[]\")' />"
                    +"</p>"
                    +"<p>"
                    +"<label for='<?=  $this->get_field_id( 'titleimg' ); ?>'><?= _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>"
                    +"<input class='widefat' type='text' id='<?=  $this->get_field_id( 'titleimg' ); ?>[]' name='<?=  $this->get_field_name( 'titleimg' ); ?>[]' value='<?=  $instance['titleimg']; ?>' />"
                    +"</p>"
                    +"<p>"
                    +"<label for='<?=  $this->get_field_id( 'linkads' ); ?>'><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>"
                    +"<input class='widefat' type='text' id='<?=  $this->get_field_id( 'linkads' ); ?>[]' name='<?=  $this->get_field_name( 'linkads' ); ?>[]' value='<?=  $instance['linkads']; ?>' />"    
                    +"</p>"
                    +"<p>"        
                    +"<label for='<?=  $this->get_field_id( 'follow' ); ?>'><?= _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>"
                    +"<input class='widefat' type='text' id='<?=  $this->get_field_id( 'follow' ); ?>[]' name='<?=  $this->get_field_name( 'follow' ); ?>[]' value='<?=  $instance['follow']; ?>' />"
                    +"</p>"
                    +"<p>"
                    +"<input type='checkbox' id='<?=  $this->get_field_id( 'blnk' ); ?>[]' name='<?=  $this->get_field_name( 'blnk' ); ?>[]' <?php checked( $instance[ 'blnk' ], 'on' ); ?> >"
                    +"<label for='<?=  $this->get_field_id( 'blnk' ); ?>'><?= _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>"
                    +"</p>"
                    +"</div></div>";


            jQuery('div#accordionArray').append(jQuery(toappend));     
            console.clear();
            
            var acc = jQuery('div#accordionArray').find("button.accordion");
            console.log(acc);

            
            jQuery('div#accordionArray').unbind().on('click', 'button.accordion', function(e){
            //jQuery('div#accordionArray').on('click', 'button.accordion', function(e){
                e.preventDefault();
                jQuery(this).toggleClass('active').parent().find('div.panel').toggleClass('show');
                return false;
            })


          /*jQuery('#btAdd'+iCnt).attr('id', 'btRemove'); */

           return false;

       }
       });

       
       jQuery('button#btRemove').click(function() {
            if (iCnt != 0) { 
                jQuery('div#tb' + iCnt).remove(); 
                iCnt = iCnt - 1;  
                jQuery('#btAdd').removeAttr('disabled');
            }

        }); 



            


        </script>      
  
<?php 
}



}

class imp_image_slider extends WP_Widget
{
    /**
     * imp_image_slider constructor.
     */
    public function __construct()
    {
        parent::__construct(false, $name = "Impulse Image Slider", array("description" => "Creates Slick Image Slider"));
    }

    /**
     * @see WP_Widget::widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
    // render widget in frontend
    }


    /**
     * @see WP_Widget::update
     *
     * @param array $newInstance
     * @param array $oldInstance
     *
     * @return array
     */
    public function update($newInstance, $oldInstance)
    {
        $instance = $oldInstance;
        $instance['images'] = array();
        $instance['urls'] = array();
        if (isset($newInstance['images'])) {
            foreach ($newInstance['images'] as $key => $value) {
                if (!empty(trim($value))) {
                    $instance['images'][$key] = $value;
                    $instance['urls'][$key] = $newInstance['urls'][$key];
                }
            }
        }

        return $instance;
    }

    /**
     * @see WP_Widget::form
     *
     * @param array $instance
     */
    public function form($instance)
    {
        $images = isset($instance['images']) ? $instance['images'] : array();
        $urls = isset($instance['urls']) ? $instance['urls'] : array();
        $images[] = '';
        $form = '';

        foreach ($images as $idx => $value) {
            $image = isset($images[$idx]) ? $images[$idx] : '';
            $url = isset($urls[$idx]) ? $urls[$idx] : '';
            $form .= '<p>'
                . '<label>Slides:</label>'
                . sprintf(
                    '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Image ID">',
                    $this->get_field_name('images'),
                    $idx,
                    esc_attr($image))
                . '</p>'
                . '<p>'
                . sprintf(
                    '<input type="text" name="%1$s[%2$s]" value="%3$s" class="widefat" placeholder="Url">',
                    $this->get_field_name('urls'),
                    $idx,
                    esc_attr($url))
                . '</p>';
        }

        echo $form;
    }
}



class Containerless_Widget extends WP_Widget{
    
    function __construct() {
        parent::__construct(
            'Containerless_Widget',
            __('[T1.2] Meta Widget', 'tieronetwopointone'),
            array( 'description' => __('Insert header tags without using the editor!', 'tieronetwopointone'), )
        );
    }
    
    public function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
        echo $before_widget;
        /*if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } */?>
            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
        <?php
        echo $after_widget;
    }
    
    public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<?php
	}
    
    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}
		$instance['filter'] = ! empty( $new_instance['filter'] );
		return $instance;
	}
    
    
}

// Creating the widget 
class tag_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'tag_widget', 

            // Widget name will appear in UI
            __('[Tier-One] Tags', 'tag_widget_domain'), 

            // Widget description
            array( 'description' => __( 'Tag Widget for Tier-One', 'tag_widget_domain' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo '<div class="tags">';
        if ( ! empty( $title ) )
            echo '<h5 class="white-text">' . $title . '</h5>';
        
        $rp = '';
        $tags = get_tags( array('orderby' => 'count', 'order' => 'DESC', 'number' => 6) );
        echo '<ul class="list-inline">';
        foreach ( (array) $tags as $tag ) {
            echo '<li><a class="grey-text text-lighten-3" href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a></li>';
        }
        echo '</ul>';

        // This is where you run the code and display the output
        echo __( $rp, 'tag_widget_domain' );
        echo '</div>';
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'wpb_widget_domain' );
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

// Creating the widget 
class recent_image_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'recent_image_widget', 

            // Widget name will appear in UI
            __('[Tier-One] Recent Image Posts', 'tiertwopointone'), 

            // Widget description
            array( 'description' => __( 'Recent Image Posts for Tier-One', 'tiertwopointone' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo '<div class="recent-image-post">';
        if ( ! empty( $title ) )
            echo '<h5 class="white-text">' . $title . '</h5>';
        
        $rp = '';
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array( 'post-format-image' )
                )
            )
        );
        $query = new WP_Query( $args ); 
        echo '<div class="row clearfix center-align" style="display:inline-block;width:100%">';
        ?>
        <?php if ( $query->have_posts() ) : ?>
            <?php while( $query->have_posts() ) : $query->the_post(); ?>
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail() ) { ?>
                    <?php
                        $file = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'multi_tab' ); 
                        $anchor = get_the_title();
                    ?>
                    <img class="responsive-img" style="width:135px;height:135px;"
                     src="<?php the_post_thumbnail_url( 'top-rated' ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>">
                    <?php } else { ?>
                    <?php
                        $file = wp_get_attachment_image_url( get_attachment_id( get_first_image() ), 'multi_tab' ); 
                        $anchor = get_the_title();
                    ?>
                    <img class="responsive-img" style="width:135px;height:135px;" src="<?php echo $file; ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" title="<?php echo $anchor; ?>" alt="<?php echo $anchor; ?>" />
                    <?php } ?>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query();
        echo '</div>';

        // This is where you run the code and display the output
        echo __( $rp, 'tag_widget_domain' );
        echo '</div>';
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'wpb_widget_domain' );
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

/**
 * Advanced Text widget class
 */
class Front_Page_Widget extends WP_Widget { 
 
  function __construct( $id = 'fpw', $descr = "Front Page Widget", $opts = array() ) {
        $widget_opts = array();
      parent::__construct($id,$descr,$widget_opts);
  }
 
  function widget( $args, $instance ) {
    // PART 1: Extracting the arguments + getting the values
    extract($args, EXTR_SKIP);
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $cat = empty($instance['category']) ? '' : $instance['category'];

    // Before widget code, if any
    echo (isset($before_widget)?$before_widget:'');

    // PART 2: The title and the text output
    if (!empty($title)){ echo $before_title . $title . $after_title; }
      if (!empty($cat)){ echo $cat; }
    

    // After widget code, if any  
    echo (isset($after_widget)?$after_widget:'');
  }
 
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['category'] = $new_instance['category'];
    return $instance;
  }
 
  function form( $instance ) {
    // PART 1: Extract the data from the instance variable
     $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
     $title = $instance['title'];
     $cat = $instance['category'];   

     // PART 2-3: Display the fields
     ?>
     <!-- PART 2: Widget Title field START -->
     <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title: 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
               name="<?php echo $this->get_field_name('title'); ?>" type="text" 
               value="<?php echo attribute_escape($title); ?>" />
      </label>
      </p>
      <!-- Widget Title field END -->

     <!-- PART 3: Widget City field START -->
        <?php 
              $args = array("hide_empty" => 0,
                            "type"      => "post",      
                            "orderby"   => "name",
                            "order"     => "ASC" );
              $types = get_categories($args);
        ?>
        
     <p>
      <label for="<?php echo $this->get_field_id('text'); ?>">Category: 
        <select class='widefat' id="<?php echo $this->get_field_id('category'); ?>"
                name="<?php echo $this->get_field_name('category'); ?>" type="text">
        <?php //echo print_r($types); 

        foreach( $types as $category ) { 
            
                ?>
                <option value='<?php echo $category->term_id; ?>' <?php echo ($cat==$category->term_id)?'selected':''; ?>><?php echo $category->name ;?></option> 

                <?php
            } 
            ?>
        </select>                
      </label>
     </p>
     <!-- Widget City field END -->
     <?php 
  }
}

function rw_cb() {
  //register_widget("Front_Page_Widget");
}
add_action('widgets_init', 'rw_cb');

class Layout_One_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_one_widget',
            __('Layout One Widget'),
            array( 'description' => __( 'Layout 1', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
            
            $args = array('posts_per_page' => 6, 'cat' => $cat ); 
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col s12 layout-one" itemscope itemtype="http://schema.org/Blog">
                    <div class="section-header blue-grey darken-4 clearfix">
                        <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                        <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                    </div>
                    <div class="section-content">
                        <div class="row clearfix">
                            <?php while( have_posts() ) : the_post(); ?>
                            <article class="col l4 m4 s6" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
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
                                <div class="s2__subs2">
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">

                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:168px; width:100%" class="responsive-img post-thumbnail" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file =  get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img first-image" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:168px; width:100%" itemprop="image" />
                                            </a>
                                        <?php } ?>

                                    </figure>
                                    <div class="subsection-header valign-wrapper hide-on-med-and-down" itemprop="articleBody">
                                        <div class="blur"></div>
                                        <h2 class="h6 bold valign" itemprop="headline"><a href="<?php get_the_permalink(); ?>" class="white-text"><?php the_title(); ?></a></h2>
                                    </div>
                                </div>
                            </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
            </section>
            <?php
            endif; wp_reset_query();
            
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

class Layout_Two_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_two_widget',
            __('Layout Two Widget'),
            array( 'description' => __( 'Layout 2', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
                            
            $args = array('posts_per_page' => 3, 'cat' => $cat ); 
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col s12 layout-two" itemscope itemtype="http://schema.org/Blog">
                <div class="section-header blue-grey darken-4 clearfix">
                    <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                </div>
                <div class="section-content">
                    <div class="row clearfix">
                        <?php while( have_posts() ) : the_post(); ?>
                        <article class="col l4 m4 s12" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
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
                            <div class="s2__subs1">
                                <div class="subsection-header">
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:168px; width:100%" class="responsive-img" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file = get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:168px; width:100%" itemprop="image" />
                                            </a>
                                        <?php } ?>

                                    </figure>
                                    <h2 class="h5 bold" itemprop="headline"><?php the_title(); ?></h2>
                                    <span style="font-size: 0.7rem">Posted on <?php the_time('F j, Y') ?> by <?php the_author(); ?></span>
                                </div>
                                <div class="subsection-content hide-on-small-only" itemprop="articleBody">
                                    <?php echo wp_trim_words( get_the_excerpt(), 20, ' ...' ) ?>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php
            endif; wp_reset_query();
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

class Layout_Three_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_three_widget',
            __('Layout Three Widget'),
            array( 'description' => __( 'Layout 3', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
                            
            $args = array('posts_per_page' => 3, 'cat' => $cat ); 
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col s12" itemscope itemtype="http://schema.org/Blog">
                <div class="section-header blue-grey darken-4 clearfix">
                    <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                </div>
                <div class="section-content">
                    <?php while( have_posts() ) : the_post(); ?>
                    <article class="row clearfix" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
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
                        <div class="col s12">
                            <div class="s2__subs3 row clearfix">
                                <div class="subsection-header col l3 s12">
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:227px; width:100%" class="responsive-img" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file = get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:227px; width:100%" itemprop="image" />
                                            </a>
                                        <?php } ?>

                                    </figure>
                                </div>
                                
                                <div class="subsection-header col l8 s12" itemprop="articleBody">
                                    <h2 class="h5 bold" itemprop="headline"><?php the_title(); ?></h2>
                                    <span style="font-size: 0.7rem">Posted on <?php the_time('F j, Y') ?> by <?php the_author(); ?></span>
                                    <p class="hide-on-small-only"><?php echo wp_trim_words( get_the_excerpt(), 25, ' ...' ) ?></p>
                                </div>
                            </div>
                        </div>
                    </article>
                     <?php endwhile; ?>
                </div>
            </section>
            <?php
            endif; wp_reset_query();
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

class Layout_Four_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_four_widget',
            __('Layout Four Widget'),
            array( 'description' => __( 'Layout 4', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
                            
            $args = array('posts_per_page' => 3, 'cat' => $cat ); $count = 1;
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col s12" itemscope itemtype="http://schema.org/Blog">
                <div class="section-header blue-grey darken-4 clearfix">
                    <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                </div>
                <div class="section-content">
                    <?php while( have_posts() ) : the_post(); ?>
                        <?php if ( $count == 1 ) : ?>
                            <article class="row clearfix" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
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
                                <div class="col s12">
                                    <div class="s2__subs4 row clearfix">
                                        <div class="subsection-header col l5 m12 s12">
                                            <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                                <?php if (has_post_thumbnail() ) { ?>
                                                <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                                <?php
                                                    $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                                    if (if_file_exists($file)) :
                                                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                        <meta itemprop="width" content="<?php echo $width; ?>">
                                                        <meta itemprop="height" content="<?php echo $height; ?>">
                                                    <?php endif; ?>
                                                        <img style="height:296px; width:100%" class="responsive-img" 
                                                 src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                                <?php } else { ?>
                                                <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                                <?php
                                                    $file = get_first_image(); 
                                                    if (if_file_exists($file)) :
                                                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                        <meta itemprop="width" content="<?php echo $width; ?>">
                                                        <meta itemprop="height" content="<?php echo $height; ?>">
                                                    <?php endif; ?>
                                                        <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:296px; width:100%" itemprop="image" />
                                                <?php } ?>

                                            </figure>
                                        </div>
                                        <div class="subsection-content col l7 m12 s12" itemprop="articleBody">
                                            <h2 class="h5 bold" itemprop="headline"><?php the_title(); ?></h2>
                                            <span style="font-size: 0.7rem">Posted on <?php the_time('F j, Y') ?> by <?php the_author(); ?></span>
                                            <p class="hide-on-med-and-down"><?php echo wp_trim_words( get_the_excerpt(), 25, ' ...' ) ?></p>
                                            <a class="waves-effect waves-light btn palette" href="<?php echo esc_url(the_permalink()); ?>">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <div class="row clearfix">
                    
                        <?php else : ?>
                                <article class="col s6" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
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
                                    <div class="s2__subs2">
                                        <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                            <?php if (has_post_thumbnail() ) { ?>
                                            <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                            <?php
                                                $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                                if (if_file_exists($file)) :
                                                    list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                    <meta itemprop="width" content="<?php echo $width; ?>">
                                                    <meta itemprop="height" content="<?php echo $height; ?>">
                                                <?php endif; ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img style="height:296px; width:100%" class="responsive-img" 
                                             src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                                </a>
                                            <?php } else { ?>
                                            <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                            <?php
                                                $file = get_first_image(); 
                                                if (if_file_exists($file)) :
                                                    list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                    <meta itemprop="width" content="<?php echo $width; ?>">
                                                    <meta itemprop="height" content="<?php echo $height; ?>">
                                                <?php endif; ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:296px; width:100%" itemprop="image" />
                                                </a>
                                            <?php } ?>

                                        </figure>
                                        <div class="subsection-header valign-wrapper hide-on-med-and-down" itemprop="articleBody">
                                            <div class="blur"></div>
                                            <h2 class="h5 bold valign"><a href="<?php the_permalink(); ?>" itemprop="headline"><?php the_title(); ?></a></h2>
                                        </div>
                                    </div>
                                </article>
                        <?php endif; ?>
                        <?php $count++; ?>
                     <?php endwhile; ?>
                            </div>
                </div>
            </section>
            <?php
            endif; wp_reset_query();
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

class Layout_Five_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_five_widget',
            __('Layout Five Widget'),
            array( 'description' => __( 'Layout 5', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
                            
            $args = array('posts_per_page' => 3, 'cat' => $cat ); $count = 1;
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col l6 m12 s12" itemscope itemtype="http://schema.org/Blog">
                <div class="section-header blue-grey darken-4 clearfix">
                    <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                </div>
                <div class="section-content">
                    <div class="row clearfix">
                    <?php while( have_posts() ) : the_post(); ?>
                        <?php if ($count == 1) : ?>
                            <div class="col s12 s2__subs1">
                                <div class="subsection-header">
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:242px; width:100%" class="responsive-img" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file = get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:242px; width:100%" itemprop="image" />
                                            </a>
                                        <?php } ?>

                                    </figure>
                                    <h2 class="h5 bold" itemprop="headline"><?php the_title(); ?></h2>
                                    <span style="font-size: 0.7rem">Posted on <?php the_time('F j, Y') ?> by <?php the_author(); ?></span>
                                </div>
                                <div class="subsection-content hide-on-small-only">
                                    <p><?php echo wp_trim_words( get_the_excerpt(), 25, ' ...' ) ?></p>
                                </div>
                            </div>
                        <?php else : ?>
                            <article class="s2__subs3 col s12" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
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
                                <div class="subsection-header col l3 s12">
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:100px; width:100%" class="responsive-img" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file = get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:100px; width:100%" itemprop="image" />
                                            </a>
                                        <?php } ?>

                                    </figure>
                                </div>

                                <div class="subsection-header col l8 s12" itemprop="articleBody">
                                    <h2 class="heading bold" itemprop="headline"><?php the_title(); ?></h2>
                                    <span style="font-size: 0.7rem">Posted on <?php the_time('F j, Y') ?> by <?php the_author(); ?></span>
                                </div>
                            </article>
                        <?php endif; ?>
                        <?php $count++; ?>
                     <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php
            endif; wp_reset_query();
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

class Layout_Six_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_six_widget',
            __('Layout Six Widget'),
            array( 'description' => __( 'Layout 6', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
                            
            $args = array('posts_per_page' => 3, 'cat' => $cat ); $count = 1;
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col s12" itemscope itemtype="http://schema.org/Blog">
                <div class="section-header blue-grey darken-4 clearfix">
                    <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                </div>
                <div class="section-content">
                    <div class="row clearfix">
                        <div class="col s12">
                            <div class="s3__subs3 row clearfix">
                            <?php while( have_posts() ) : the_post(); ?>
                                <article class="subsection-header col l4 m4 s12" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                                    <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
                                    <header class="entry-meta site-meta-t">
                                        <meta itemprop="author" content="<?php the_author();?>">
                                        <meta itemprop="headline" content="<?php the_title();?>">
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
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:180px; width:100%" class="responsive-img" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file = get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:180px; width:100%" itemprop="image" />
                                            </a>
                                        <?php } ?>
                                        <figcaption>
                                            <a class="white-text" href="<?php the_permalink(); ?>" itemprop="caption"><?php the_title(); ?></a>
                                        </figcaption>
                                    </figure>
                                </article>
                            <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            endif; wp_reset_query();
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

class Layout_Seven_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_seven_widget',
            __('Layout Seven Widget'),
            array( 'description' => __( 'Layout 7', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
                            
            $args = array('posts_per_page' => 5, 'cat' => $cat ); $count = 1;
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col s12" itemscope itemtype="http://schema.org/Blog">
                <div class="section-header blue-grey darken-4 clearfix">
                    <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                </div>
                <div class="section-content s2__subs">
                    <div class="row clearfix">
                        <?php while( have_posts() ) : the_post(); ?>
                            <?php if ( $count == 1) : ?>
                             <article class="col l5 m12 s12" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                                <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
                                <header class="entry-meta site-meta-t">
                                    <meta itemprop="author" content="<?php the_author();?>">
                                    <meta itemprop="headline" content="<?php  the_title(); ?>">
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
                                <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" style="position:relative;">
        
                                    <?php if (has_post_thumbnail() ) { ?>
                                    <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                    <?php
                                        $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                        if (if_file_exists($file)) :
                                            list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                            <meta itemprop="width" content="<?php echo $width; ?>">
                                            <meta itemprop="height" content="<?php echo $height; ?>">
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img style="height:474px;" class="responsive-img" 
                                     src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                        </a>
                                    <?php } else { ?>
                                    <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                    <?php
                                        $file = get_first_image(); 
                                        if (if_file_exists($file)) :
                                            list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                            <meta itemprop="width" content="<?php echo $width; ?>">
                                            <meta itemprop="height" content="<?php echo $height; ?>">
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:474px;" itemprop="image" />
                                        </a>
                                    <?php } ?>
                                    <figcaption>
                                        <a class="white-text" href="<?php the_permalink(); ?>" itemprop="caption"><?php the_title(); ?></a>
                                    </figcaption>
                                    <?php
                                    $category = get_the_category(); 
                                    ?>
                                    <small><a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) );?>"><?php echo $category[0]->cat_name;?></a></small>
                                </figure>
                            </article>
                            <div class="col l7 m12 s12">
                            <?php elseif ( $count == 2 ) : ?>
                             <article class="row clearfix" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                                <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
                                <header class="entry-meta site-meta-t">
                                    <meta itemprop="author" content="<?php the_author();?>">
                                    <meta itemprop="headline" content="<?php  the_title(); ?>">
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
                                <div class="col l12 m12 s12">
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" style="position:relative;">
        
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:233px;" class="responsive-img" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file = get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:233px;" itemprop="image" />
                                            </a>
                                        <?php } ?>
                                        <figcaption>
                                            <a class="white-text" href="<?php the_permalink(); ?>" itemprop="caption"><?php the_title(); ?></a>
                                        </figcaption>
                                        <?php
                                        $category = get_the_category(); 
                                        ?>
                                        <small><a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) );?>"><?php echo $category[0]->cat_name;?></a></small>
                                    </figure>
                                </div>
                            </article>   
                            <div class="row clearfix">
                            <?php else : ?>
                                <article class="col l4 m4 s6" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                                    <link itemprop="mainEntityOfPage" href="<?php echo esc_url( get_permalink() );?>" />
                                    <header class="entry-meta site-meta-t">
                                        <meta itemprop="author" content="<?php the_author();?>">
                                        <meta itemprop="headline" content="<?php  the_title(); ?>">
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
                                    <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" style="position:relative;">
        
                                        <?php if (has_post_thumbnail() ) { ?>
                                        <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                        <?php
                                            $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img style="height:236px;" class="responsive-img" 
                                         src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                            </a>
                                        <?php } else { ?>
                                        <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                        <?php
                                            $file = get_first_image(); 
                                            if (if_file_exists($file)) :
                                                list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                                <meta itemprop="width" content="<?php echo $width; ?>">
                                                <meta itemprop="height" content="<?php echo $height; ?>">
                                            <?php endif; ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:236px;" itemprop="image" />
                                            </a>
                                        <?php } ?>
                                        <figcaption>
                                            <a class="white-text" href="<?php the_permalink(); ?>" itemprop="caption"><?php the_title(); ?></a>
                                        </figcaption>
                                        <?php
                                        $category = get_the_category(); 
                                        ?>
                                        <small><a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) );?>"><?php echo $category[0]->cat_name;?></a></small>
                                    </figure>
                                </article>
                            <?php endif; ?>
                            <?php $count++; ?>
                        <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            endif; wp_reset_query();
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

class Layout_Eight_Widget extends Front_Page_Widget { 
    
    function __construct() {
        parent::__construct(
            'layout_eight_widget',
            __('Layout Eight Widget'),
            array( 'description' => __( 'Layout 8', 'tiertwopointone' ), ) 
        );
    }

    function widget( $args, $instance ) {
        // PART 1: Extracting the arguments + getting the values
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $cat = empty($instance['category']) ? '' : $instance['category'];

        // Before widget code, if any
        echo (isset($before_widget)?$before_widget:'');

        // PART 2: The title and the text output
        if (!empty($title)){ echo $before_title . $title . $after_title; }
        if (!empty($cat)){ 
                            
            $args = array('posts_per_page' => 4, 'cat' => $cat ); $count = 1;
            query_posts($args); 
            if(have_posts()) :
            ?>
            <section class="section col s12" itemscope itemtype="http://schema.org/Blog">
                <div class="section-header blue-grey darken-4 clearfix">
                    <h1 class="h5 left"><?php echo get_cat_name( $cat ); ?></h1>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="right"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                </div>
                <div class="section-content s2__subs">
                    <div class="s3__subs1 row clearfix">
                        <?php while( have_posts() ) : the_post(); ?>
                        <article class="col l3 m6 s12 " itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
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
                            <figure class="figure" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        
                                <?php if (has_post_thumbnail() ) { ?>
                                <meta itemprop="url" content="<?php the_post_thumbnail_url(); ?>">
                                <?php
                                    $file = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                                    if (if_file_exists($file)) :
                                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                        <meta itemprop="width" content="<?php echo $width; ?>">
                                        <meta itemprop="height" content="<?php echo $height; ?>">
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img style="height:126px;" class="responsive-img" 
                                 src="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" itemprop="image">
                                    </a>
                                <?php } else { ?>
                                <meta itemprop="url" content="<?php echo get_first_image(); ?>">
                                <?php
                                    $file = get_first_image(); 
                                    if (if_file_exists($file)) :
                                        list($width, $height, $type, $attr) = getimagesize($file);  ?>
                                        <meta itemprop="width" content="<?php echo $width; ?>">
                                        <meta itemprop="height" content="<?php echo $height; ?>">
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="responsive-img" src="<?php echo get_first_image(); ?>" onerror="javascript:this.src='<?php echo get_template_directory_uri() . "/images/default.jpg"; ?>'" style="height:126px;" itemprop="image" />
                                    </a>
                                <?php } ?>

                            </figure>
                        </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php
            endif; wp_reset_query();
        }


        // After widget code, if any  
        echo (isset($after_widget)?$after_widget:'');
    }


}

function rw_cb_2() {
register_widget("layout_one_widget");
register_widget("layout_two_widget");
register_widget("layout_three_widget");
register_widget("layout_four_widget");
register_widget("layout_five_widget");
register_widget("layout_six_widget");
register_widget("layout_seven_widget");
register_widget("layout_eight_widget");
}
add_action('widgets_init', 'rw_cb_2');


// Register and load the widget
function load_widget() {
     register_widget( 'ads_720x90_widget' );
     register_widget( 'ads_300x300_widget' );
     register_widget( 'ads_150x150_multiple_widget' );
     register_widget( 'imp_image_slider');
     register_widget( 'Containerless_Widget' );
    register_widget( 'tag_widget' );
    register_widget( 'recent_image_widget' );
    
    /*register_widget( 'ttwopointone_widget_text' );
 
  // Allow to execute shortcodes on ttwopointone_widget_text
  add_filter('ttwopointone_widget_text', 'do_shortcode');*/
    
    //register_widget( 'front_page_widget' );
    
    //register_widget( 'layout_one_widget' );
}
add_action( 'widgets_init', 'load_widget' );


