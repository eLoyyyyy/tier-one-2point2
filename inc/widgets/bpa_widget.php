<?php
/*  
    UNG 150x150 nila JEM AT BRYAN 
*/

class bpa_widget extends WP_Widget {


  function __construct() {
        parent::__construct(
            // Base ID of your widget
            'bpa_widget', 
            // Widget name will appear in UI
            __('[TOD3] Banner Ads x6', 'bpa_widget_domain'), 

            // Widget description
            array( 'description' => __( '6 Banners in a 2x3 Grid.', 'tod3' ), ) 
        );
    }


    public function widget($args, $instance){
        
        extract( $args );

        $title = apply_filters('widget_title', $instance['title']);

        $linkads = $instance['linkads'];
        $imgads = $instance['imgads'];
        $blnk = $instance[ 'blnk' ] ? 'true' : 'false';
        $follow = $instance['follow'];
     
        $linkads_2 = $instance['linkads_2'];
        $imgads_2 = $instance['imgads_2'];
        $blnk_2 = $instance[ 'blnk_2' ] ? 'true' : 'false';
        $follow_2 = $instance['follow_2'];

        $linkads_3 = $instance['linkads_3'];
        $imgads_3 = $instance['imgads_3'];
        $blnk_3 = $instance[ 'blnk_3' ] ? 'true' : 'false';
        $follow_3 = $instance['follow_3'];

        $linkads_4 = $instance['linkads_4'];
        $imgads_4 = $instance['imgads_4'];
        $blnk_4 = $instance[ 'blnk_4' ] ? 'true' : 'false';
        $follow_4 = $instance['follow_4'];

        $linkads_5 = $instance['linkads_5'];
        $imgads_5 = $instance['imgads_5'];
        $blnk_5 = $instance[ 'blnk_5' ] ? 'true' : 'false';
        $follow_5 = $instance['follow_5'];     

        $linkads_6 = $instance['linkads_6'];
        $imgads_6 = $instance['imgads_6'];
        $blnk_6 = $instance[ 'blnk_6' ] ? 'true' : 'false';
        $follow_6 = $instance['follow_6'];

        $titleimg  = $instance['titleimg']; 
        $titleimg_2  = $instance['titleimg_2']; 
        $titleimg_3  = $instance['titleimg_3']; 
        $titleimg_4  = $instance['titleimg_4']; 
        $titleimg_5  = $instance['titleimg_5']; 
        $titleimg_6  = $instance['titleimg_6']; 


        echo $before_widget;     
?>



        <?php /*if ( $title ) :
        
            echo $before_title . esc_html( $title ) . $after_title;
        
        endif; */?>

         <div class="section-content ">
            <div class="row clearfix flexbox-container center-align">
         
                 <div class="col l6 m4 s6">
                    <a href="<?php echo $linkads; ?>" target="<?php echo ($blnk == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow ?>">
                        <img class="responsive-img" src="<?php echo $imgads; ?>" title="<?php echo $titleimg; ?>" alt="<?php echo $titleimg; ?>"/>
                     </a>      
                 </div>
                 <div class="col l6 m4 s6">
                    <a href="<?php echo $linkads_2; ?>" target="<?php echo ($blnk_2 == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow_2 ?>">
                        <img class="responsive-img" src="<?php echo $imgads_2; ?>" title="<?php echo $titleimg_2; ?>" alt="<?php echo $titleimg_2; ?>"/>
                     </a>
                 </div>
                 <div class="col l6 m4 s6">

                    <a href="<?php echo $linkads_3; ?>" target="<?php echo ($blnk_3 == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow_3 ?>">
                        <img class="responsive-img" src="<?php echo $imgads_3; ?>" title="<?php echo $titleimg_3; ?>" alt="<?php echo $titleimg_3; ?>"/>
                    </a>
                 </div>
                 <div class="col l6 m4 s6">
                    <a href="<?php echo $linkads_4; ?>" target="<?php echo ($blnk_4 == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow_4 ?>">
                        <img class="responsive-img" src="<?php echo $imgads_4; ?>" title="<?php echo $titleimg_4; ?>" alt="<?php echo $titleimg_4; ?>"/>
                    </a>
                 </div>
                 <div class="col l6 m4 s6">
                    <a href="<?php echo $linkads_5; ?>" target="<?php echo ($blnk_5 == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow_5 ?>">
                        <img class="responsive-img" src="<?php echo $imgads_5; ?>" title="<?php echo $titleimg_5; ?>" alt="<?php echo $titleimg_5; ?>"/>
                    </a>
                 </div>
                 <div class="col l6 m4 s6">
                    <a href="<?php echo $linkads_6; ?>" target="<?php echo ($blnk_6 == 'true' ? '_blank' : ''); ?>" rel="<?php echo $follow_6 ?>">
                        <img class="responsive-img" src="<?php echo $imgads_6; ?>" title="<?php echo $titleimg_6; ?>" alt="<?php echo $titleimg_6; ?>"/>
                     </a>
                 </div>
            </div>
             <div class="center">
                <span class="ad-sign">Advertisements</span>
            </div>

        </div>

    <?php
        echo $after_widget;
    }



     public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
       
        $instance['linkads']        = $new_instance['linkads'];
        $instance['imgads']         = $new_instance['imgads'];
        $instance['blnk']           = $new_instance[ 'blnk' ] ;
        $instance['follow']         = $new_instance['follow'];

        $instance['linkads_2']        = $new_instance['linkads_2'];
        $instance['imgads_2']         = $new_instance['imgads_2'];
        $instance['blnk_2']           = $new_instance[ 'blnk_2' ] ;
        $instance['follow_2']         = $new_instance['follow_2'];

        $instance['linkads_3']        = $new_instance['linkads_3'];
        $instance['imgads_3']         = $new_instance['imgads_3'];
        $instance['blnk_3']           = $new_instance[ 'blnk_3' ] ;
        $instance['follow_3']         = $new_instance['follow_3'];

        $instance['linkads_4']        = $new_instance['linkads_4'];
        $instance['imgads_4']         = $new_instance['imgads_4'];
        $instance['blnk_4']           = $new_instance[ 'blnk_4' ] ;
        $instance['follow_4']         = $new_instance['follow_4'];


        $instance['linkads_5']        = $new_instance['linkads_5'];
        $instance['imgads_5']         = $new_instance['imgads_5'];
        $instance['blnk_5']           = $new_instance[ 'blnk_5' ] ;
        $instance['follow_5']         = $new_instance['follow_5'];

        $instance['linkads_6']        = $new_instance['linkads_6'];
        $instance['imgads_6']         = $new_instance['imgads_6'];
        $instance['blnk_6']           = $new_instance[ 'blnk_6' ] ;
        $instance['follow_6']         = $new_instance['follow_6'];


        $instance['titleimg']         = $new_instance['titleimg'];
        $instance['titleimg_2']         = $new_instance['titleimg_2'];
        $instance['titleimg_3']         = $new_instance['titleimg_3'];
        $instance['titleimg_4']         = $new_instance['titleimg_4'];
        $instance['titleimg_5']         = $new_instance['titleimg_5'];
        $instance['titleimg_6']         = $new_instance['titleimg_6'];


        return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
            $title      = $instance[ 'title' ];
            
            $linkads    = $instance['linkads'];
            $imgads     = $instance['imgads'];   
            $blnk       = $instance['blnk'];
            $follow     = $instance['follow'];
            $titleimg     = $instance['titleimg']; 


            $linkads_2    = $instance['linkads_2'];
            $imgads_2     = $instance['imgads_2'];
            $blnk_2       = $instance['blnk_2'];
            $follow_2     = $instance['follow_2'];
            $titleimg_2     = $instance['titleimg_2']; 

            $linkads_3    = $instance['linkads_3'];
            $imgads_3     = $instance['imgads_3'];
            $blnk_3       = $instance['blnk_3'];
            $follow_3     = $instance['follow_3'];
            $titleimg_3     = $instance['titleimg_3']; 

            $linkads_4    = $instance['linkads_4'];
            $imgads_4     = $instance['imgads_4'];
            $blnk_4       = $instance['blnk_4'];
            $follow_4     = $instance['follow_4'];
            $titleimg_4     = $instance['titleimg_4']; 

            $linkads_5    = $instance['linkads_5'];
            $imgads_5    = $instance['imgads_5'];
            $blnk_5       = $instance['blnk_5'];
            $follow_5    = $instance['follow_5'];
            $titleimg_5     = $instance['titleimg_5'];

            $linkads_6    = $instance['linkads_6'];
            $imgads_6     = $instance['imgads_6'];
            $blnk_6      = $instance['blnk_6'];
            $follow_6     = $instance['follow_6'];
            $titleimg_6     = $instance['titleimg_6'];

        }
        else {
            $title =    __( 'New title', 'bpa_widget_domain' );
            
            $linkads =  __( '', 'bpa_widget_domain' );
            $imgads =   __( '', 'bpa_widget_domain' );
            $blnk =     __( 'off', 'bpa_widget_domain' );
            $follow =   __( '', 'bpa_widget_domain' );

            $linkads_2 =  __( '', 'bpa_widget_domain' );
            $imgads_2 =   __( '', 'bpa_widget_domain' );
            $blnk_2 =     __( 'off', 'bpa_widget_domain' );
            $follow_2 =   __( '', 'bpa_widget_domain' );

            $linkads_3 =  __( '', 'bpa_widget_domain' );
            $imgads_3 =   __( '', 'bpa_widget_domain' );
            $blnk_3 =     __( 'off', 'bpa_widget_domain' );
            $follow_3 =   __( '', 'bpa_widget_domain' );

            $linkads_4 =  __( '', 'bpa_widget_domain' );
            $imgads_4 =   __( '', 'bpa_widget_domain' );
            $blnk_4 =     __( 'off', 'bpa_widget_domain' );
            $follow_4 =   __( '', 'bpa_widget_domain' );

            $linkads_5 =  __( '', 'bpa_widget_domain' );
            $imgads_5 =   __( '', 'bpa_widget_domain' );
            $blnk_5 =     __( 'off', 'bpa_widget_domain' );
            $follow_5 =   __( '', 'bpa_widget_domain' );

            $linkads_6 =  __( '', 'bpa_widget_domain' );
            $imgads_6 =   __( '', 'bpa_widget_domain' );
            $blnk_6 =     __( 'off', 'bpa_widget_domain' );
            $follow_6 =   __( '', 'bpa_widget_domain' );

            $titleimg =   __( '', 'bpa_widget_domain' );
            $titleimg_2 =   __( '', 'bpa_widget_domain' );
            $titleimg_3 =   __( '', 'bpa_widget_domain' );
            $titleimg_4 =   __( '', 'bpa_widget_domain' );
            $titleimg_5 =   __( '', 'bpa_widget_domain' );
            $titleimg_6 =   __( '', 'bpa_widget_domain' );

        }
        // Widget admin form
/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

         <!--  Banner Promo Ads -->   

        <h3><?php _e( 'Promo Banner Ads', '[Tier-One] Promo Ads' ); ?></h3>
        <h4><?php _e( 'Using image:', '[Tier-One] Promo Ads' ); ?></h4>
        <p>
        <label for="<?php echo $this->get_field_id( 'imgads' ); ?>"><?php _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads' ); ?>" name="<?php echo $this->get_field_name( 'imgads' ); ?>" value="<?php echo $instance['imgads']; ?>" />
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads' ); ?>" value="<?php _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads' ); ?>' ); return false;"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'titleimg' ); ?>"><?php _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg' ); ?>" name="<?php echo $this->get_field_name( 'titleimg' ); ?>" value="<?php echo $instance['titleimg']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkads' ); ?>"><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads' ); ?>" name="<?php echo $this->get_field_name( 'linkads' ); ?>" value="<?php echo $instance['linkads']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'follow' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow' ); ?>" name="<?php echo $this->get_field_name( 'follow' ); ?>" value="<?php echo $instance['follow']; ?>" />
        </p>
        <p>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk' ); ?>" name="<?php echo $this->get_field_name( 'blnk' ); ?>" <?php checked( $instance[ 'blnk' ], 'on' ); ?> >
        <label for="<?php echo $this->get_field_id( 'blnk' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>
        </p>
  
        <!--  Banner Promo Ads 2 -->      

        <h3><?php _e( 'Promo Banner Ads 2', '[Tier-One] Promo Ads' ); ?></h3>
        <h4><?php _e( 'Using image:', '[Tier-One] Promo Ads' ); ?></h4>
        <p>
        <label for="<?php echo $this->get_field_id( 'imgads_2' ); ?>"><?php _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads_2' ); ?>" name="<?php echo $this->get_field_name( 'imgads_2' ); ?>" value="<?php echo $instance['imgads_2']; ?>" />
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads_2' ); ?>" value="<?php _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads_2' ); ?>' ); return false;"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'titleimg_2' ); ?>"><?php _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg_2' ); ?>" name="<?php echo $this->get_field_name( 'titleimg_2' ); ?>" value="<?php echo $instance['titleimg_2']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkads_2' ); ?>"><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads_2' ); ?>" name="<?php echo $this->get_field_name( 'linkads_2' ); ?>" value="<?php echo $instance['linkads_2']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'follow_2' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow_2' ); ?>" name="<?php echo $this->get_field_name( 'follow_2' ); ?>" value="<?php echo $instance['follow_2']; ?>" />
        </p>
        <p>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk_2' ); ?>" name="<?php echo $this->get_field_name( 'blnk_2' ); ?>" <?php checked( $instance[ 'blnk_2' ], 'on' ); ?> >
        <label for="<?php echo $this->get_field_id( 'blnk_2' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>
        </p>

        <!--  Banner Promo Ads 3 -->      

        <h3><?php _e( 'Promo Banner Ads 3', '[Tier-One] Promo Ads' ); ?></h3>
        <h4><?php _e( 'Using image:', '[Tier-One] Promo Ads' ); ?></h4>
        <p>
        <label for="<?php echo $this->get_field_id( 'imgads_3' ); ?>"><?php _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads_3' ); ?>" name="<?php echo $this->get_field_name( 'imgads_3' ); ?>" value="<?php echo $instance['imgads_3']; ?>" />
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads_3' ); ?>" value="<?php _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads_3' ); ?>' ); return false;"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'titleimg_3' ); ?>"><?php _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg_3' ); ?>" name="<?php echo $this->get_field_name( 'titleimg_3' ); ?>" value="<?php echo $instance['titleimg_3']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkads_2' ); ?>"><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads_3' ); ?>" name="<?php echo $this->get_field_name( 'linkads_3' ); ?>" value="<?php echo $instance['linkads_3']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'follow_2' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow_3' ); ?>" name="<?php echo $this->get_field_name( 'follow_3' ); ?>" value="<?php echo $instance['follow_3']; ?>" />
        </p>
        <p>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk_3' ); ?>" name="<?php echo $this->get_field_name( 'blnk_3' ); ?>" <?php checked( $instance[ 'blnk_3' ], 'on' ); ?> >
        <label for="<?php echo $this->get_field_id( 'blnk_3' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>
        </p>

        <!--  Banner Promo Ads 4 -->      

        <h3><?php _e( 'Promo Banner Ads 4', '[Tier-One] Promo Ads' ); ?></h3>
        <h4><?php _e( 'Using image:', '[Tier-One] Promo Ads' ); ?></h4>
        <p>
        <label for="<?php echo $this->get_field_id( 'imgads_4' ); ?>"><?php _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads_4' ); ?>" name="<?php echo $this->get_field_name( 'imgads_4' ); ?>" value="<?php echo $instance['imgads_4']; ?>" />
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads_4' ); ?>" value="<?php _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads_4' ); ?>' ); return false;"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'titleimg_4' ); ?>"><?php _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg_4' ); ?>" name="<?php echo $this->get_field_name( 'titleimg_4' ); ?>" value="<?php echo $instance['titleimg_4']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkads_4' ); ?>"><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads_4' ); ?>" name="<?php echo $this->get_field_name( 'linkads_4' ); ?>" value="<?php echo $instance['linkads_4']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'follow_4' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow_4' ); ?>" name="<?php echo $this->get_field_name( 'follow_4' ); ?>" value="<?php echo $instance['follow_4']; ?>" />
        </p>
        <p>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk_4' ); ?>" name="<?php echo $this->get_field_name( 'blnk_4' ); ?>" <?php checked( $instance[ 'blnk_4' ], 'on' ); ?> >
        <label for="<?php echo $this->get_field_id( 'blnk_4' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>
        </p>

        <!--  Banner Promo Ads 5 -->      

        <h3><?php _e( 'Promo Banner Ads 5', '[Tier-One] Promo Ads' ); ?></h3>
        <h4><?php _e( 'Using image:', '[Tier-One] Promo Ads' ); ?></h4>
        <p>
        <label for="<?php echo $this->get_field_id( 'imgads_5' ); ?>"><?php _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads_5' ); ?>" name="<?php echo $this->get_field_name( 'imgads_5' ); ?>" value="<?php echo $instance['imgads_5']; ?>" />
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads_5' ); ?>" value="<?php _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads_5' ); ?>' ); return false;"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'titleimg_5' ); ?>"><?php _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg_5' ); ?>" name="<?php echo $this->get_field_name( 'titleimg_5' ); ?>" value="<?php echo $instance['titleimg_5']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkads_5' ); ?>"><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads_5' ); ?>" name="<?php echo $this->get_field_name( 'linkads_5' ); ?>" value="<?php echo $instance['linkads_5']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'follow_5' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow_5' ); ?>" name="<?php echo $this->get_field_name( 'follow_5' ); ?>" value="<?php echo $instance['follow_5']; ?>" />
        </p>
        <p>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk_5' ); ?>" name="<?php echo $this->get_field_name( 'blnk_5' ); ?>" <?php checked( $instance[ 'blnk_5' ], 'on' ); ?> >
        <label for="<?php echo $this->get_field_id( 'blnk_5' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>
        </p>    

         <!--  Banner Promo Ads 6 -->      

        <h3><?php _e( 'Promo Banner Ads 6', '[Tier-One] Promo Ads' ); ?></h3>
        <h4><?php _e( 'Using image:', '[Tier-One] Promo Ads' ); ?></h4>
        <p>
        <label for="<?php echo $this->get_field_id( 'imgads_6' ); ?>"><?php _e( 'Image Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'imgads_6' ); ?>" name="<?php echo $this->get_field_name( 'imgads_6' ); ?>" value="<?php echo $instance['imgads_6']; ?>" />
        <input type="button" class="button button-primary custom_media_button" id="custom_media_button"  name="<?php echo $this->get_field_name( 'imgads_6' ); ?>" value="<?php _e( 'Upload Image', '[Tier-One] Promo Ads' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( 'imgads_6' ); ?>' ); return false;"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'titleimg_6' ); ?>"><?php _e( 'Anchor Title:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'titleimg_6' ); ?>" name="<?php echo $this->get_field_name( 'titleimg_6' ); ?>" value="<?php echo $instance['titleimg_6']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkads_6' ); ?>"><?php _e( 'Target Url:', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkads_6' ); ?>" name="<?php echo $this->get_field_name( 'linkads_6' ); ?>" value="<?php echo $instance['linkads_6']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'follow_6' ); ?>"><?php _e( 'Link Relationship (XFN):', '[Tier-One] Promo Ads' ); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'follow_6' ); ?>" name="<?php echo $this->get_field_name( 'follow_6' ); ?>" value="<?php echo $instance['follow_6']; ?>" />
        </p>
        <p>
        <input type="checkbox" id="<?php echo $this->get_field_id( 'blnk_6' ); ?>" name="<?php echo $this->get_field_name( 'blnk_6' ); ?>" <?php checked( $instance[ 'blnk_6' ], 'on' ); ?> >
        <label for="<?php echo $this->get_field_id( 'blnk_6' ); ?>"><?php _e( 'Open Link in a new tab', '[Tier-One] Promo Ads' ); ?></label>
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